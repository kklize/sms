<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class do_sms
{
    public $sms;
    
    public function __construct()
    {
        //查询当前使用的是哪个第三方接口
         $ci = &get_instance();
         
         $ci->load->model('Sms_model');
         
         $result = $ci->Sms_model->getRowByEffect();
         if(!empty($result))
         {
             $class_name = strtolower($result['class_name']);

             $ci->load->library("$class_name");
             
             $object = $class_name;
             
             $this->sms = new $object();
             
         }else
         {
             //默认
             $ci->load->library('ym_sms');
             $this->sms = new ym_sms();
         }
    }
    
    public function sendSMS($mobile_number,$content,$smsID)
    {      
        return $this->sms->sendSMS($mobile_number, $content, $smsID);
    }
    
    public function getStatusReport()
    {
        $this->sms->getStatusReport();
    }
}
?>