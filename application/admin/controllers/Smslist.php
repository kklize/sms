<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Smslist extends Admin_Controller
{

    private $per_page = 10;
    public function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->model('Smslist_model');
        $page = 1;
        if(!empty($this->input->get_post('p',true)))
        {
            $page = $this->input->get_post('p',true);
        }

        $where = ' where 1';
        if(!empty($_GET['mobile'])){
            $where .= ' and mobile = "'.$_GET['mobile'].'"';
        }
        if(!empty($_GET['mer_id'])){
            $where .= ' and mer_id = "'.$_GET['mer_id'].'"';
        }
        if(!empty($_GET['ssid'])){
            $where .= ' and ssid = "'.$_GET['ssid'].'"';
        }
        if(isset($_GET['is_addqueue'])){
            if($_GET['is_addqueue']==1 || $_GET['is_addqueue']==0){
                $where .= ' and is_addqueue = '.$_GET['is_addqueue'];
            }
        }
        if(isset($_GET['send_status'])){
            if($_GET['send_status']==1 || $_GET['send_status']==0){
                $where .= ' and send_status = '.$_GET['send_status'];
            }
        }
        if(isset($_GET['send_result'])) {
            if ($_GET['send_result'] == 1 || $_GET['send_result'] == 0) {
                $where .= ' and send_result = ' . $_GET['send_result'];
            }
        }
        if(isset($_GET['receive_result'])) {
            if ($_GET['receive_result'] == 1 || $_GET['receive_result'] == 0) {
                $where .= ' and receive_result = ' . $_GET['receive_result'];
            }
        }
        if(!empty($_GET['send_msg'])){
            $where .= ' and send_msg = "'.$_GET['send_msg'].'"';
        }
        if(!empty($_GET['business_type'])){
            $where .= ' and business_type = '.$_GET['business_type'];
        }
        if(!empty($_GET['sms_class'])){
            $where .= ' and sms_class = '.$_GET['sms_class'];
        }
        if(!empty($_GET['report_data'])){
            $where .= ' and report_data = "'.$_GET['report_data'].'"';
        }
        if(!empty($_GET['report_msg'])){
            $where .= ' and report_msg = "'.$_GET['report_msg'].'"';
        }
        if(!empty($_GET['start_create_time'])){
            $where .= ' and create_time >= "'.$_GET['start_create_time'].'"';
        }
        if(!empty($_GET['end_create_time'])){
            $where .= ' and create_time <= "'.$_GET['end_create_time'].'"';
        }
        if(!empty($_GET['start_send_time'])){
            $where .= ' and send_time >= "'.$_GET['start_send_time'].'"';
        }
        if(!empty($_GET['end_send_time'])){
            $where .= ' and send_time <= "'.$_GET['end_send_time'].'"';
        }
//        var_dump($where);die;
        $result = $this->Smslist_model->getList($page,$this->per_page,$where);
        //分页类引入
        $this->load->library('pagination');

        $config['base_url'] = site_url('smslist/index');
        $config['total_rows'] = $this->Smslist_model->getCount($where);
        $config['per_page'] = $this->per_page;

        $this->pagination->initialize($config);

        $page = $this->pagination->create_links();

        $data['result'] = $result;
        $data['page'] = $page;

        $this->load->view('smslist/index',$data);
    }
}