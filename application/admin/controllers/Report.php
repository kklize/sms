<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends Admin_Controller
{

    private $per_page = 10;
    public function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->model('report_model');
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
        if(isset($_GET['is_show'])){
            if($_GET['is_show']==1 || $_GET['is_show']==0){
                $where .= ' and is_show = '.$_GET['is_show'];
            }
        }
        if(isset($_GET['receive_result'])){
            if($_GET['receive_result']==1 || $_GET['receive_result']==0){
                $where .= ' and receive_result = '.$_GET['receive_result'];
            }
        }
        if(!empty($_GET['sms_list_id'])){
            $where .= ' and sms_list_id = "'.$_GET['sms_list_id'].'"';
        }
        if(!empty($_GET['report_msg'])){
            $where .= ' and report_msg = '.$_GET['report_msg'];
        }
        if(!empty($_GET['start_receive_time'])){
            $where .= ' and receive_time >= "'.$_GET['start_receive_time'].'"';
        }
        if(!empty($_GET['end_receive_time'])){
            $where .= ' and receive_time <= "'.$_GET['end_receive_time'].'"';
        }
        $result = $this->report_model->getList($page,$this->per_page,$where);
        //分页类引入
        $this->load->library('pagination');

        $config['base_url'] = site_url('report/index');
        $config['total_rows'] = $this->report_model->getCount($where);
        $config['per_page'] = $this->per_page;

        $this->pagination->initialize($config);

        $page = $this->pagination->create_links();

        $data['result'] = $result;
        $data['page'] = $page;

        $this->load->view('report/index',$data);
    }

    public function edit_display()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->model('Admin_model');

        $this->load->model('Role_model');

        if(!empty($_GET['id']))
        {
            $id = $_GET['id'];

            $current_user = $this->Admin_model->getCurrentUser($id);

            if(!empty($current_user))
            {
                $data['current_user'] = $current_user;

            }else{
                header("location:".site_url("user/index"));
            }


            //获取所有角色类型信息
            $allroles = $this->Role_model->getAllRoles();

            $data['all_roles'] = $allroles;

            $this->load->view('user/edit_display',$data);
        }else{
            header("location:".site_url("user/index"));
        }
    }
}