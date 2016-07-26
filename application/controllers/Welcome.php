<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	  /*  $this->load->library('test');
	   
	   $test = new CI_Test();
	   
	   $test->index(); */
	    /* $this->load->library('do_sms');
	    $test = new do_sms();
	    $test->sendSMS('1','2',3);  */
	    
/*         $this->load->library('ym_sms');
	    $ym_sms = new ym_sms();
	    $result = $ym_sms->getStatusReport(); 
	    print_r($result);exit;  */
// 	    $this->load->driver('cache', array('adapter' => 'redis'));
// 	    $add_queue = $this->cache->redis->LPUSH('test', '123');
// 	    var_dump($add_queue);exit;
		$this->load->view('welcome_message'); 
	}
	
	public function test()
	{
	    $curl_url = 'http://192.168.33.10:8090/message/sendSms?'
	        .'mername='.base64_encode(urlencode('hello_test')).'&keycode='.base64_encode(urlencode('lize_test123456'))
	           .'&business_type=ok&mobile='.base64_encode(urlencode('13958065413')).'&content='.base64_encode(urlencode('hello !小倩倩')).'&ssid=1234566';
	    
	    $return_arr = $this->curl_Nav($curl_url);
	    
	    print_r($return_arr);
	    
	}
	
	public function curl_Nav($url)
	{
	    $ch = curl_init();
	    	
	    $this_header = array(
	        "content-type: application/x-www-form-urlencoded;charset=UTF-8"
	    );
	    	
	    curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    $output = curl_exec($ch);
	    curl_close($ch);
	   
	    $phpArr = json_decode($output);
	    	
	    return $phpArr;
	}
}
