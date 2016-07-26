<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Access extends Admin_Controller
{
	
	private $per_page = 10;
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Roleaccess_model');
		
		$this->load->model('Role_model');
		
		if(!empty($_GET['id']))
		{
			$role_id = $_GET['id'];
			
			$current_role = $this->Role_model->getCurrentRole($role_id);
			
			if(empty($current_role))
			{
				header("location:".site_url("access/role_list"));
			}
			
			$access_list = include_once BASEPATH.'ci_admnode_cfg.php';
				
			foreach ($access_list as $key => $value)
			{
				//先查询对应模块
				if($this->Roleaccess_model->search_role_module($role_id,$key) === true)
				{
					//代表有对应的模块	
					$access_list[$key]['module_auth'] = 1;//模块被授权	
				}else
				{
					$access_list[$key]['module_auth'] = 0;//模块被授权
				}	

				$node_list = $value['node'];
				
				foreach ($node_list as $k => $v)
				{
				    if($role_id != 1)
				    {
				        //非超级管理员
				        if(isset($v['belong']) && $v['belong']== 'admin')
				        {
				            unset($node_list[$k]);
				            continue;
				        }
				    }
				    
					if($this->Roleaccess_model->search_role_action($role_id,$key,$v['action']) == true)
					{
						$node_list[$k]['node_auth'] = 1; //方法被授权
					}else{
						$node_list[$k]['node_auth'] = 0;
					}
				}
				
				$access_list[$key]['node'] = $node_list;
				
			}
			
			$data['access_list'] = $access_list;
			
			$data['role_id'] = $role_id;
			
			$this->load->view('access/index',$data);
			
		}else{
			header("location:".site_url("access/role_list"));
		}
	}
	
	public function role_list()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Role_model');
		
		$page = 1;
		
		if(!empty($this->input->get_post('p',true)))
		{
			$page = $this->input->get_post('p',true);
		}
		
		$result = $this->Role_model->getRoleList($page,$this->per_page);
		
		//分页类引入
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('access/role_list');
		
		$config['total_rows'] = $this->Role_model->getCount();
		
		$config['per_page'] = $this->per_page;
		
		$this->pagination->initialize($config);
		
		$page = $this->pagination->create_links();
		
		$data['result'] = $result;
		
		$data['page'] = $page;
		
		$this->load->view('access/role_list',$data);
	}
	
	//权限添加
	public function add_access()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Role_model');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('role_name', 'Role_name',
				array(
						'trim',
						'required',
						'is_unique[role.role_name]'
				),
				array('required'=>'角色名不能为空','is_unique' => '角色名已存在')
		);
		
		if ($this->form_validation->run() == FALSE)
		{
				
			$this->load->view('access/add_access');
		}else
		{
			//初步简单验证后进行数据比对
			$role_name = $this->input->post('role_name');
			
			$insert = $this->Role_model->insert($role_name);

			if($insert)
			{
				header("location:".site_url("access/role_list"));
			}else{
				print '插入失败';
			}
			
		}		
	}
	
	
	public function update()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Roleaccess_model');
		
		if(!empty($_POST))
		{
			$role_id = $this->input->get_post('role_id');
			
			//删除对应角色的数据
			$this->Roleaccess_model->delete($role_id);
					
			if(isset($_POST['role_access']))
			{
				$role_access = $_POST['role_access'];
				
				foreach ($role_access as $key => $value)
				{
					$position = strpos($key, '__');
					$module = trim(substr($key, 0,$position));
					$action = trim(substr($key,$position+2));
					
					
					$this->Roleaccess_model->insert($role_id,$module,$action);
					
				}	
			}
			
			header("location:".site_url("access/role_list"));
			
			
		}else{
			header("location:".site_url("access/role_list"));
		}
	}
}
