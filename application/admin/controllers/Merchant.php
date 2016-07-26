<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Merchant extends Admin_Controller
{
	
	private $per_page = 10;
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Merchant_model');
		
		$page = 1;
		if(!empty($this->input->get_post('p',true)))
		{
			$page = $this->input->get_post('p',true);
		}		

		$result = $this->Merchant_model->getMerchantList($page,$this->per_page);
		
		
		//分页类引入
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('merchant/index');
		
		$config['total_rows'] = $this->Merchant_model->getCount();
		
		$config['per_page'] = $this->per_page;
		
		$this->pagination->initialize($config);
		
		$page = $this->pagination->create_links();
		
		$data['result'] = $result;
		
		$data['page'] = $page;

		
		$this->load->view('merchant/index',$data);
	}
	
	public function edit_display()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Merchant_model');
		
		if(!empty($_GET['apikey']))
		{
			$apikey = $_GET['apikey'];
			
			$current_merchant = $this->Merchant_model->getCurrentMerchant($apikey);
			
			if(!empty($current_merchant))
			{
				$data['current_merchant'] = $current_merchant[0]; 
				
			}else{
				header("location:".site_url("merchant/index"));
			}
			
			$this->load->view('merchant/edit_display',$data);
		}else{
			header("location:".site_url("merchant/index"));
		}
	}
	
	public function update()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Merchant_model');
		
		if(!empty($_POST))
		{
			$this->load->library('form_validation');
			
			$apikey = $this->input->get_post('apikey',true);
			
			$name = $this->input->get_post('name',true);
			
			$user_name = $this->input->get_post('user_name',true);
			
			$mobile = $this->input->get_post('mobile',true);
			
			$apisecret = $this->input->get_post('apisecret',true);
			
			$description = $this->input->get_post('description',true);
			
			$this->form_validation->set_rules('name', 'name',
					array(
							'trim',
							'required'
					),
					array('required'=>'商户全称不能为空')
			);
			
			$this->form_validation->set_rules('user_name', 'user_name',
					array(
							'trim',
							'required'
					),
					array('required'=>'商户用户名不能为空')
			);
			
			$this->form_validation->set_rules('mobile', 'mobile',
					array(
							'trim',
							'numeric',
							'max_length[11]'
					),
					array('numeric'=>'商户联系方式格式错误','max_length'=>'联系方式不得超过11位')
			);
			
			$this->form_validation->set_rules('apisecret', 'apisecret',
					array(
							'trim',
							'required'
					),
					array('required'=>'鉴权密码不能为空')
			);
			
			
			if ($this->form_validation->run() == FALSE)
			{
				$current_merchant = array(
						'apikey' => $apikey,
						'name' => $name,
						'user_name' => $user_name,
						'mobile' => $mobile,
						'apisecret' => $apisecret,
						'description' => $description
				);
				$data['current_merchant'] = $current_merchant; 
				$data['err'] = validation_errors();
				
				
				$this->load->view('merchant/edit_display',$data);
				
			}else{
				
				if(!empty($apikey)){
					
					$result = $this->Merchant_model->updatebyapikey($apikey,$name,$user_name,$mobile,$apisecret,$description);
					
					if($result === true)
					{
						header("location:".site_url("merchant/index"));
					}else{
						print '编辑失败';
					}
				}
				
			}
			
		}else{
			print '编辑失败';
		}
	}
	
	public function add_display(){
		$this->load->view('merchant/add_display');
	}
	
	public function add(){
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Merchant_model');
		
		if(!empty($_POST))
		{
			$this->load->library('form_validation');
				
			$apikey = $this->input->get_post('apikey',true);
				
			$name = $this->input->get_post('name',true);
				
			$user_name = $this->input->get_post('user_name',true);
				
			$mobile = $this->input->get_post('mobile',true);
				
			$apisecret = $this->input->get_post('apisecret',true);
				
			$description = $this->input->get_post('description',true);
			
			$this->form_validation->set_rules('apikey','apikey',
					array(
							'trim',
							'is_unique[merchant.apikey]'
					),
					array('is_unique' => '鉴权账号已存在')
					);
			
			$this->form_validation->set_rules('name', 'name',
					array(
							'trim',
							'required'
					),
					array('required'=>'商户全称不能为空')
					);
				
			$this->form_validation->set_rules('user_name', 'user_name',
					array(
							'trim',
							'required'
					),
					array('required'=>'商户用户名不能为空')
					);
				
			$this->form_validation->set_rules('mobile', 'mobile',
					array(
							'trim',
							'numeric',
							'max_length[11]'
					),
					array('numeric'=>'商户联系方式格式错误','max_length'=>'联系方式不得超过11位')
					);
				
			$this->form_validation->set_rules('apisecret', 'apisecret',
					array(
							'trim',
							'required'
					),
					array('required'=>'鉴权密码不能为空')
					);
			if($this->form_validation->run() == FALSE){
				$current_merchant = array(
						'apikey' => $apikey,
						'name' => $name,
						'user_name' => $user_name,
						'mobile' => $mobile,
						'apisecret' => $apisecret,
						'description' => $description
				);
				$data['current_merchant'] = $current_merchant;
				$data['err'] = validation_errors();
				
				
				$this->load->view('merchant/add_display',$data);
			}else{
				$result = $this->Merchant_model->addmerchant($apikey,$name,$user_name,$mobile,$apisecret,$description);
				
				if($result === true)
				{
					header("location:".site_url("merchant/index"));
				}else{
					print '添加失败';
				}
			}
		}else{
			print '添加失败';
		}
		
	}
	
	public function delete(){
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Merchant_model');
		
		if(!empty($_GET['apikey']))
		{
			$apikey = $_GET['apikey'];
			
			$result = $this->Merchant_model->deletebyapikey($apikey);
			
			if($result === true)
			{
				header("location:".site_url("merchant/index"));
			}else{
				print '删除失败';
			}
			
		}else{
			print  '删除失败';
		}
	}
}