<?php
class Sms_model extends CI_Model
{
	protected  $_collection  = 'sms';
	function __construct()
	{
		parent::__construct();
	}

	function getRows($condition = array(),$start = NULL, $limit = NULL)
	{
		$this->db->order_by('is_effect','desc');
		$this->db->order_by('id', 'desc');
		if (!empty($condition['name']))
		{
			$this->db->like('name',$condition['name']);
			unset($condition['name']);
		}
		$query = $this->db->get_where($this->_collection, $condition, $limit, $start);
		//var_dump($this->db->last_query());die;
		return $query->result_array();
	}
	
	function getCounts($condition=array())
	{
		$query = $this->db->get_where($this->_collection, $condition);
		return $query->num_rows();
	}
	
	function insert($name,$class_name,$description)
	{
		$data = array(
				'name'=>$name,
				'class_name'=>$class_name,
				'description'=>$description,
				'is_effect'=>0,
				'sort'=>0
		);
		$this->db->insert($this->_collection,$data);
		/* $error = $this->db->error();
		var_dump($error);die; */
		return $this->db->affected_rows();
	}
	
	function effect($id) {
		
		$data = array('is_effect' => 0);
		
		$where = "is_effect = 1";
		
		$this->db->update($this->_collection, $data, $where);
		$data = array('is_effect' => 1);
		
		$where = "id = ".$id;
		
		$str = $this->db->update($this->_collection, $data, $where);
		
		return $this->db->affected_rows();
	}
	
	function invalid($id) {
		$data = array('is_effect' => 0);
	
		$where = "id = ".$id." AND is_effect = 1";
		
		$str = $this->db->update($this->_collection, $data, $where);
		return $this->db->affected_rows();
	}
	
	function getOneById($id)
	{
		$arr = array('id'=>$id);
		$query = $this->db->get_where($this->_collection,$arr);
		return $query->row_array();
	}
	
	function update($id, $data)
	{
		$where = "id = ".$id;

		$str = $this->db->update($this->_collection, $data, $where);
		
		return $this->db->affected_rows();
	}
	

	function is_unique($class_name, $id=NULL)
	{
		$arr = array('class_name' => $class_name );
		if ($id){
			$arr = array('class_name' => $class_name, 'id !='=>$id);
		}
		$query = $this->db->get_where($this->_collection,$arr);
		return $query->row_array();
	}
	
	function getRowByEffect()
	{
	    $query = $this->db->query("select class_name from ".$this->_collection." where is_effect = 1 order by id asc limit 1");
	    
	    $row = $query->row_array();
	    
	    return $row;
	    
	}
}