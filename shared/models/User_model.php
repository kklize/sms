<?php
class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getAllUser()
	{
		$query = $this->db->get('user');
		
		return $query->result_array();
		
	}
}