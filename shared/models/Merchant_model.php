<?php
class Merchant_model extends CI_Model
{
	public $table = 'merchant';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getMerchantList($page = 1 , $page_limit_count = 10)
	{
	    $start = ($page - 1) * $page_limit_count;
	    
		$query = $this->db->query("select * from ".$this->table." where is_delete = 1 limit ".$start.",".$page_limit_count);
		
		$result = $query->result_array();
		
		return $result;
	}
	
	public function getCount()
	{
		$query = $this->db->query("select count(*) as count from ".$this->table);
	
		$result = $query->row();
	
		return $result->count;
	}
	
	public function getCurrentMerchant($apikey)
	{
		$query = $this->db->query("select * from ".$this->table." where apikey = '".$apikey."'");
	
		$result = $query->result_array();
	
		return $result;
	}
	
	public function updatebyapikey($apikey,$name,$user_name,$mobile,$apisecret,$description){
		
		$result = $this->db->query("update ".$this->table." set name = '".$name."', user_name = '".$user_name."' , mobile = '".$mobile."' , apisecret = '".$apisecret."' , description = '".$description."' where apikey = '".$apikey."'");

		return $result;
	}
	
	public function addmerchant($apikey,$name,$user_name,$mobile,$apisecret,$description){
		
		$data = array(
				'name' => $name,
				'user_name' => $user_name,
				'mobile' => $mobile,
				'apikey' => $apikey,
				'apisecret' => $apisecret,
				'description' => $description,
				'create_time' => date('Y-m-d H:i:s',time()),
				'is_delete' => 1
		);
		
		$insert  = $this->db->insert($this->table, $data);
		
		return $insert;
	}
	
	public function deletebyapikey($apikey){
		
		$result = $this->db->query("update ".$this->table." set is_delete = 2 where apikey = '".$apikey."'");
		
		return $result;
	}
	
	public function getByUsername($mer_name) {
		
		$query = $this->db->get_where($this->table,array('user_name'=>$mer_name));
		
		return $query->row_array();
	}
	
}