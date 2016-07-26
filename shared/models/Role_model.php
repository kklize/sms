<?php
class Role_model extends CI_Model
{
	public $table = 'role';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function insert($role_name = '')
	{
		$data = array(
				'role_name' => $role_name,
		);
		
		$insert  = $this->db->insert($this->table, $data);
		
		return $insert;
	}
	
	public function getRoleList($page = 1 , $page_limit_count = 10)
	{
	    $start = ($page - 1) * $page_limit_count;
	    
		$query = $this->db->query("select * from ".$this->table." limit ".$start.",".$page_limit_count);
	
		$result = $query->result_array();
	
		return $result;
	}
	
	public function getCount()
	{
		$query = $this->db->query("select count(*) as count from ".$this->table);
		
		$result = $query->row();
		
		return $result->count;
	}
	
	public function getCurrentRole($id)
	{
		$query = $this->db->query("select * from ".$this->table." where id = ".$id);
		
		$result = $query->result_array();
		
		return $result;
	}	
	
	public function getAllRoles()
	{
		$query = $this->db->query("select * from ".$this->table);
		
		$result = $query->result_array();
		
		return $result;
		
	}
	
}