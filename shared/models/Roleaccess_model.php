<?php
class Roleaccess_model extends CI_Model
{
	public $table = 'role_access';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function search_role_module($role_id , $module = '')
	{
		$query = $this->db->query("select * from ".$this->table." where role_id = ".$role_id." and module = '".$module."'");
	
		$result = $query->row();
	
		if(!empty($result))
		{
			return true;
				
		}else{
			return false;
		}
	}
	
	public function search_role_action($role_id , $module = '' , $action = '')
	{
		$query = $this->db->query("select * from ".$this->table." where role_id = ".$role_id." and module = '".$module."' and action = '".$action."'");
	
		$result = $query->row();
	
		if(!empty($result))
		{
			return true;
	
		}else{
			return false;
		}
	}
	
	//删除对应角色数据
	public function delete($role_id)
	{
		$delete = $this->db->delete($this->table, array('role_id' => $role_id));
		
		return $delete;
	}
	
	//insert 角色数据
	public function insert($role_id , $module = '' ,$action = '')
	{
		$data = array(
				'module' => $module,
				'action' => $action,
				'role_id' => $role_id
		);
		
		$insert  = $this->db->insert($this->table, $data);
		
		return $insert;
	}
}