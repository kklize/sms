<?php
class Smsreport_model extends CI_Model
{
    public $table = 'sms_report';
    
    public function insert($data = array())
    {
        $arr = array(
            'receive_result' => $data['receive_result'],
            'receive_time' => $data['receive_time'],
            'report_data' => $data['report_data'],
            'report_msg' => $data['report_msg'],           
            'ssid' => $data['ssid'],
            'sms_list_id' => $data['sms_list_id'],
            'mobile' => $data['mobile'],
            'is_show' => '0',
        	'mer_id' => $data['mer_id']
        );
        
        $insert = $this->db->insert($this->table,$arr);
        
        return $insert;
    }
    
    public function getListForShow($mer_id,$limit = 100) {
    	 
    	$this->db->order_by('id desc');
    	$this->db->select(array(
    			'id',
    			'receive_result',
    			'report_msg',
    			'receive_time',
    			'ssid',
    			'mobile'
    	));
    	$query = $this->db->get_where($this->table, array('mer_id'=>$mer_id,'is_show'=>'0'), $limit);
    	return $query->result_array();
    }
    
    public function batchUpdate($ids=array()) {
    	if (!empty($ids)) {
    		$this->db->where_in('id', $ids);
    		$this->db->update($this->table, array('is_show'=>'1'));
    
    		return $this->db->affected_rows();
    	}
    }
}
?>