<?php
class Sms extends Admin_Controller{
	/*function index() {
		 $config_data = array(
				'server_url' => 'http://sdk4report.eucp.b2m.cn:8080/sdk/SDKService',
				'user_name' => '6SDK-EMY-6688-JCZSP',
				'password' => '698650'
		);
		$this->load->library('YM_sms', $config_data);
		//$result =  $this->ym_sms->sendSMS('15267125137', '测试11111', '1');
		//var_dump($result);die;
		$this->ym_sms->getStatusReport();
		$this->ym_sms->getMO(); 
	}*/
	
	function __construct() {
		parent::__construct();
		$this->load->model('Sms_model');
		$this->load->helper('common');
	}
	public function index() {
		$this->load->library('pagination');
		$page = $this->input->get('p');
		if (empty($page)){
			$page = 1;
		}
		$name = trim($this->input->get('name'));
		$is_effect = $this->input->get('is_effect');
		$condition = array();
		if ( ! empty($name)) {
			$condition['name'] = $name;
		}
		if ($is_effect != '') {
			$condition['is_effect'] = intval($is_effect);
		}
		$config['base_url'] = site_url('sms/index');
		$config['total_rows'] = $this->Sms_model->getCounts($condition);
		$this->pagination->initialize($config);
		$data['page'] =  $this->pagination->create_links();
		$data['list'] = $this->Sms_model->getRows($condition,($page-1)*$this->pagination->per_page,$this->pagination->per_page);
		if (!empty($data['list'])) {
			foreach ($data['list'] as $k=>$v) {
				if ($v['is_effect'] == '1') {
					$data['list'][$k]['is_effect_label'] = '已启用';
				}else{
					$data['list'][$k]['is_effect_label'] = '不启用';
				}
			}
		}
		$data['name'] = $name;
		$data['is_effect'] = $is_effect;
		$this->load->view('sms_index', $data);
	}
	
	public function add() {
		$data = $this->input->post();
		if ( ! empty($data)) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','接口名称','required', array('required'=>'接口名称不能为空'));
			$this->form_validation->set_rules('class_name','接口类名','required|is_unique[sms.class_name]',array('required'=>'接口类名不能为空','is_unique'=>'接口类名已存在'));
			if ($this->form_validation->run() === false){
				echo_json(array('0'=>'error','1'=>validation_errors()));
			}
			$result = $this->Sms_model->insert($data['name'], $data['class_name'], $data['description']);
			if ( ! $result) {
				echo_json(array('0'=>'error','1'=>'新增失败'));
			}
			echo_json(array('0'=>'success','1'=>'新增成功'));
		}
		$this->load->view('sms_add');
	}
	
	public function edit() {
		$id = $this->input->get('id');
		$list['sms'] = $this->Sms_model->getOneById($id);
		$data = $this->input->post();
		if ( ! empty($data)) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','接口名称','required', array('required'=>'接口名称不能为空'));
			$this->form_validation->set_rules('class_name','接口类名','required',array('required'=>'接口类名不能为空'));
			if ($this->Sms_model->is_unique($data['class_name'], $data['id'])) {
				echo_json(array('0'=>'error','1'=>'接口类名已存在'));
			}
			if ($this->form_validation->run() === false){
				echo_json(array('0'=>'error','1'=>validation_errors()));
			}
			$result = $this->Sms_model->update($data['id'], $data);
			if ( ! $result) {
				echo_json(array('0'=>'error','1'=>'更新失败'));
			}
			echo_json(array('0'=>'success','1'=>'更新成功'));
		}
		$this->load->view('sms_edit', $list); 
	}
	
	public function effect()
	{
		$id = intval($this->input->get('id'));
		$result = $this->Sms_model->effect($id);
		if ($result) {
			redirect('sms/index');
		}
	}
	
	public function invalid()
	{
		$id = intval($this->input->get('id'));
		$result = $this->Sms_model->invalid($id);
		if ($result) {
			redirect('sms/index');
		}
	}
}