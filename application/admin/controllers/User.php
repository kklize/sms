<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends Admin_Controller
{
	
	private $per_page = 10;
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Admin_model');
		
		$page = 1;
		if(!empty($this->input->get_post('p',true)))
		{
			$page = $this->input->get_post('p',true);
		}		

		$result = $this->Admin_model->getAdminList($page,$this->per_page);
		
		
		//分页类引入
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('user/index');
		
		$config['total_rows'] = $this->Admin_model->getCount();
		
		$config['per_page'] = $this->per_page;
		
		$this->pagination->initialize($config);
		
		$page = $this->pagination->create_links();
		
		$data['result'] = $result;
		
		$data['page'] = $page;

		
		$this->load->view('user/index',$data);
	}
	
	public function edit_display()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Admin_model');
		
		$this->load->model('Role_model');
		
		if(!empty($_GET['id']))
		{
			$id = $_GET['id'];
			
			$current_user = $this->Admin_model->getCurrentUser($id);
			
			if(!empty($current_user))
			{
				$data['current_user'] = $current_user; 
				
			}else{
				header("location:".site_url("user/index"));
			}
			
			
			//获取所有角色类型信息
			$allroles = $this->Role_model->getAllRoles();
			
			$data['all_roles'] = $allroles;
			
			$this->load->view('user/edit_display',$data);
		}else{
			header("location:".site_url("user/index"));
		}
	}
	
	public function update()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Admin_model');
		
		if(!empty($_POST))
		{
			$id = $this->input->get_post('id',true);
			
			$user_name = $this->input->get_post('adm_username',true);
			
			$adm_password = $this->input->get_post('adm_password',true);
			
			$role_id = $this->input->get_post('role_id',true);
			
			if(empty($role_id))
			{
				print '请选择角色';
				exit;
			}
			
			if($this->Admin_model->search_user($id,$user_name) == true)
			{
				//查询到对应的数据，只修改密码
				$data = array(
						'adm_password' => $adm_password,
						'role_id' => $role_id
				);
				
				$this->db->where('id', $id);
				$update = $this->db->update('admin', $data);
				
				
			}else{
				//查询不到对应的数组，修改用户名和密码
				$data = array(
						'adm_username' => $user_name,
						'adm_password' => $adm_password,
						'role_id' => $role_id
				);
				
				$this->db->where('id', $id);
				$update = $this->db->update('admin', $data);
			}
			
			
			header("location:".site_url("user/index"));
			
		}else{
			header("location:".site_url("user/index"));
		}
	}
}