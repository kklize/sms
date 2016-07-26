<?php
class Admin_Controller extends CI_Controller
{
	public function __construct()
	{	
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		if(empty($this->is_logged_in()))
		{
			 header("location:".site_url("admin/index"));
			
		}else
		{
			//查询登录的用户是否有权限访问
 			$module = $this->uri->segment(1);
			$action = $this->uri->segment(2);

			$this->load->library('session');
			$role_result = $this->session->role_result;
			
			if(!empty($role_result))
			{
				$have_role = false;
				foreach ($role_result as $key => $value)
				{
					if($value['module'] == $module && $value['action'] == $action)
					{
						$have_role = true;
						break;
					}else{
						continue;
					}
				}	
				
				if($have_role === false)
				{
					print "无权限访问";exit;
				}
			}else{
				print '无权限访问';exit;
			} 
		}
	}
	
	public function is_logged_in()
	{
		$this->load->library('session');
		$logged_in = $this->session->logged_in;
		return $logged_in;
	}
}

