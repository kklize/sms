<?php
class Report_model extends CI_Model
{
    public $table = 'sms_report';

    public function __construct()
    {
        parent::__construct();
    }

    public function getList($page = 1 , $page_limit_count = 10 , $where)
    {
        $start = ($page - 1) * $page_limit_count;
        $query = $this->db->query("select * from ".$this->table.$where." limit ".$start.",".$page_limit_count);

        $result = $query->result_array();

        return $result;
    }

    public function getCount($where)
    {
        $query = $this->db->query("select count(*) as count from ".$this->table.$where);
        $result = $query->row();

        return $result->count;
    }

    public function insert($data = array())
    {
        if(!empty($data))
        {
            $arr = array(
                'mobile' => $data['mobile'],
                'content' => $data['content'],
                'mer_id' => $data['mer_id'],
                'ssid' => $data['ssid'],
                'create_time' => date('Y-m-d H:i:s',time()),
                'send_status' => 0, //未发送状态
                'send_result' => '',//还没发送，所以没结果
                'send_msg' => '',
                'send_data' => '',
                'send_time' => '',
                'receive_result' => '',
                'receive_time' => '',
                'report_data' => '',
                'report_msg' => '',
                'sms_class' => '',
                'business_type' => $data['business_type'],
                'description' => ''
            );

            $insert = $this->db->insert($this->table,$arr);

            if($insert)
            {
                return $this->db->insert_id();
            }else
            {
                return false;
            }

        }else
        {
            return false;
        }
    }

    function getRowByIdMobile($smslist_id,$mobile)
    {
        $query = $this->db->query("select id,ssid,mobile, mer_id from ".$this->table." where id = ".$smslist_id." and mobile = '".$mobile."' and is_addqueue = 0 limit 1");

        $row = $query->row_array();

        return $row;

    }
}