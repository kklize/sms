<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends My_Controller {
	
	function __construct() {
		parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
/* 		$this->output->cache(1);
		
		$this->load->model('User_model');
		
		$result = $this->User_model->getAllUser();	
		
		$data['result'] = $result;*/
	    
	   /* $this->load->driver('cache', array('adapter' => 'redis'));
	   $this->cache->redis->is_supported(); 
	   echo $this->cache->redis->RPOP('test-list'); */
	   // var_dump($this->cache->redis->get_metadata('test','123'));
	   // var_dump($this->cache->redis->get_metadata('test'));exit;
	   

       //$this->load->library('ym_sms');
	   //$test = new CI_ym_sms();
	   
	   //$result = $test->sendSMS('15824192179','再来一条lala',2222); 
	   //$result = $test->getStatusReport();
	   
/* 	    $this->load->library('do_sms');
	    $test = new CI_Do_sms();
	    $test->sendSMS('15824192179', 'dddd', 4444); */
		$this->load->driver('cache');
		var_dump($this->cache->redis->LPOP('send_message_list'));
	   
		$this->load->view('welcome_message'); 
	}
	
	/**
	 * 发送短信接口，（可批量，可单条）
	 * 确定传送的数据进行验证，
	 * 返回相应的结果信息
	 * 需传递的参数有mername，mobile，keycode,content,ssid,business_type
	 * 返回json格式的数据
	 */
	public function sendSms()
	{
		$this->load->helper('common');
		$mer_name = $this->input->get('mername');
		$mer_name = urldecode(base64_decode($mer_name));
		
		$mobile = $this->input->get('mobile');
		$mobile = urldecode(base64_decode($mobile));
		
		$keycode = $this->input->get('keycode');
		$keycode = urldecode(base64_decode($keycode));
		
		$content = $this->input->get('content');
		$content = urldecode(base64_decode(str_replace(" ","+",$content)));
		
		$ssid = $this->input->get('ssid');
		
		$business_type = $this->input->get('business_type');
		
		$validate = merchant_validation($mer_name, $keycode);
		if ( $validate['code'] != '000') {
			echo_json($validate);
		}
		$mer_id = $validate['mer_id'];
		
		$mobile = str_replace('，', ',', $mobile);
		$mobile = explode(',', $mobile);
		$validate = mobile_validation($mobile);
		if ( $validate['code'] != '000') {
			echo_json($validate);
		} 
		
		if ( empty($content)) {
			echo_json(array('code'=>'006','msg'=>'短信内容不能为空'));
		}
		
		if (strlen($ssid) > 18) {
			echo_json(array('code'=>'007','msg'=>'ssid必须控制在18位以内'));
		}
		if ( ! empty($mobile)) {
			//调用redis缓存入队
			$this->load->driver('cache');
			$data = array(
					'mobile' => $mobile,
					'content' => $content,
					'mer_id' => $mer_id,
					'business_type' => $business_type,
					'ssid' => $ssid
			);
			$data = serialize($data);
			$this->cache->redis->LPUSH('send_message_list', $data);
			echo_json(array('code'=>'000','msg'=>'短信发送成功'));
		}
	}
	
	/**
	 * 状态报告接口，默认返回最新的500条记录，并且只被调用一次
	 * 从表里查询出还未被调用的数据返回给商户
	 * 提供的参数，mername,keycode,limit
	 * 返回的数据是mobile,receivedate,ssid,code,msg
	 */
	public function getStatusReport() {
		$this->load->helper('common');
		
		$mer_name = $this->input->get('mername');
		$mer_name = urldecode(base64_decode($mer_name));
		
		$keycode = $this->input->get('keycode');
		$keycode = urldecode(base64_decode($keycode));
		
		$limit = intval($this->input->get('limit'));
		if ($limit > 500) {
			$limit = 500;
		}
		$validate = merchant_validation($mer_name, $keycode);
		if ($validate['code'] != '000') {
			echo_json($validate);
		}
		$mer_id = $validate['mer_id'];
		$this->load->model('Smsreport_model');
		$list = $this->Smsreport_model->getListForShow($mer_id, $limit);
		$result = array();
		$ids = array();
		if ( ! empty($list)) {
			foreach ($list as $k => $v) {
				$ids[$k] = $v['id'];
				if ($v['receive_result'] == '1') {
					$result[$k]['code'] = '000';
				}else {
					$result[$k]['code'] = '008';
				}
				$result[$k]['msg'] = $v['report_msg'];
				$result[$k]['mobile'] = $v['mobile'];
				$result[$k]['ssid'] = $v['ssid'];
				$result[$k]['receivedate'] = $v['receive_time'];
			}
			if (!empty($ids)) {
				$this->Smsreport_model->batchUpdate($ids);
			}
			echo_json($result);
		}
		echo_json(array('code'=>'009','msg'=>'没有数据'));
	}
	
}
