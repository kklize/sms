<?php
class Admin_model extends CI_Model
{
	public $table = 'admin';
	
	public function __construct()
	{
		parent::__construct();
	}

	//验证登录用户名是否存在
 
	
	public function dologin($user_name,$password)
	{
		$query = $this->db->query("select id,adm_username,adm_password,role_id from ".$this->table." where adm_username = '".$user_name."'");

		$result = $query->row();
		
		if(!empty($result) && $result->adm_password == $password)
		{			
			
			$this->load->library('session');
			//登录成功将信息保存到session中
			
			//获取对应用户的权限信息
			$query_access = $this->db->query("select * from role_access where role_id = ".$result->role_id);
			
			$role_result = $query_access->result_array();
			
			
			$newdata = array(
					'id' => $result->id,
					'adm_username'  => $result->adm_username,		
					'role_result' => $role_result,		
					'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			
			return true;			
		}else{
			return false;		
		}
	}
	
	public function getAdminList($page = 1 , $page_limit_count = 10)
	{
	    $start = ($page - 1) * $page_limit_count;
	    
		$query = $this->db->query("select ad.*,ro.role_name from ".$this->table." as ad left join role as ro on ro.id = ad.role_id  limit ".$start.",".$page_limit_count);
		
		$result = $query->result_array();
		
		return $result;
	}
	
	public function getCount()
	{
		$query = $this->db->query("select count(*) as count from ".$this->table);
		
		$result = $query->row();
		
		return $result->count;
	}
	
	public function getCurrentUser($id)
	{
		$query = $this->db->query("select * from admin where id = ".$id);
		
		$result = $query->row_array();
		
		return $result;
	}
	
	public function search_user($id,$user_name)
	{
		$query = $this->db->query("select id from admin where id =".$id." and adm_username = '".$user_name."'");
		
		$result = $query->row();
		
		if(!empty($result))
		{
			return true;
		}else{
			return false;
		}
	}
}