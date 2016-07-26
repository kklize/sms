<?php
class Admin extends CI_Controller 
{	
	public function index()
	{	    
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Admin_model');
		
		$this->load->library('session');
		if($this->session->userdata('id'))
		{		  
			header("location:".site_url("user/index"));
		}else{
		    $user_name = $this->input->cookie('adm_username');
		    $password = $this->input->cookie('adm_password');
		   
		    if(!empty($user_name) && !empty($password))
		    {

		        $result = $this->Admin_model->dologin($user_name,$password);
		        
		        if($result === true)
		        {
		           
		            header("location:".site_url("user/index"));
		        } 
		    }
		}
	
		$data['log_fail_message'] = ''; //验证用户密码是否正确的提示信息
				
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('adm_username', 'adm_username',
				 array(				
				 		'trim', 		
				 		'required',
				 	),
				array('required'=>'用户名不能为空')
		); 
		$this->form_validation->set_rules('adm_password', 'adm_password', 'trim|required',
				array('required' => '密码不能为空')
		);
				
		if ($this->form_validation->run() == FALSE)
		{
		    //获取cookies值
			$this->load->view('admin_index',array('err'=>validation_errors()));
		}
		else
		{
			//初步简单验证后进行数据比对
			$adm_username = $this->input->post('adm_username');
			
			$adm_password = $this->input->post('adm_password');
			
			$remember = $this->input->post('remember');
			
			if(!empty($adm_username) && !empty($adm_password))
			{
				//验证用户名密码
				$result = $this->Admin_model->dologin($adm_username,$adm_password);
				
				if($result === true)
				{
					//代表登录成功 页面跳转
					
				    if(!empty($remember))
				    {
				        //设置cookies
				        setcookie("adm_username", $adm_username, time()+3600);
				        setcookie("adm_password", $adm_password, time()+3600);     
				    }
				    
					 header("location:".site_url("user/index"));
					
				}else{
					$data['err'] = '用户名或者密码不正确';
					$this->load->view('admin_index',$data);
				}			
			}
		}
		
		
	}
	
	public function logout()
	{
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->session->sess_destroy();
		
		//清除cookie
		setcookie("adm_username","",time()-1);
		setcookie("adm_password","",time()-1);
		
		header("location:".site_url("admin/index"));
		
	}
}
?>