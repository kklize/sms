<?php
/*
默认配置 短信接口 使用方式
 $this->load->library('ym_sms');
 $test = new ym_sms();
 
 营销配置 短信接口使用方式
$params = array('type_yingxiao' => true);
$this->load->library('ym_sms',$params);
$test = new ym_sms();
*/
defined('BASEPATH') OR exit('No direct script access allowed');
require_once SHARED_PATH.'sms/sms.php';
require_once SHARED_PATH."sms/YM/transport.php";
require_once SHARED_PATH."sms/YM/include/client.php";
class ym_sms implements sms
{
    public $sms;
    
    public $add_content = false;
    
    public function __construct($arr = array('type_yingxiao'=> false))
    {
      
        //设置初始参数
        $config = include SHARED_PATH."sms/YM/default_config.php";
        if($arr['type_yingxiao'] === true)
        {
            $config = include SHARED_PATH."sms/YM/yingxiao_config.php";
            
            $this->add_content = true;
        }

        $this->sms['server_url'] = $config['server_url'];
        $this->sms['user_name'] = $config['user_name'];
        $this->sms['password'] = $config['password'];
               
    }
    
    /*
     * $mobile_number 手机号
     * $content 短信内容
     * $smsID 客户端唯一id ,主要用于获取短信状态报告*/
    public function sendSMS($mobile_number,$content,$smsID)
    {
        $connectTimeOut = 2;
        $readTimeOut = 10;
        $proxyhost = false;
        $proxyport = false;
        $proxyusername = false;
        $proxypassword = false;
        $client = new Client($this->sms['server_url'],$this->sms['user_name'],$this->sms['password'],$this->sms['password'],$proxyhost,$proxyport,$proxyusername,$proxypassword,$connectTimeOut,$readTimeOut);
        $client->setOutgoingEncoding("GBK");
        
        if($this->add_content === true)
        {
            $content = $content." 回N退订";
        }
        
        $send_mobile = array('0' => $mobile_number);
        
        $statusCode = $client->sendSMS($send_mobile,mb_convert_encoding($content,'gbk','utf-8'),'','','GBK',5,$smsID);
        
        $result['send_data'] = $statusCode;
        if($statusCode == 0){
            $result['status'] = 1;
            $result['msg'] = '发送成功';
            $result['class_name'] = 'ym_sms';           
        }else{
            $result['status'] = 0;
            $result['msg'] = '发送失败';
            $result['class_name'] = 'ym_sms';
        }

        return $result;
    }
    
    /*
     * 获取短信报告
     * 经过测试，能正常获取
     * 获取数据案例
     * array (size=8)
  'errorCode' => string 'DELIVRD' (length=7)
  'memo' => string '' (length=0)
  'mobile' => string '15824192179' (length=11)
  'receiveDate' => string '20160711143043' (length=14)
  'reportStatus' => string '0' (length=1)
  'seqID' => string '2222' (length=4)
  'serviceCodeAdd' => string '' (length=0)
  'submitDate' => string '20160711143029' (length=14)
     * */
    public function getStatusReport()
    {
        $connectTimeOut = 2;
        $readTimeOut = 10;
        $proxyhost = false;
        $proxyport = false;
        $proxyusername = false;
        $proxypassword = false;
        
        $client = new Client($this->sms['server_url'],$this->sms['user_name'],$this->sms['password'],$this->sms['password'],$proxyhost,$proxyport,$proxyusername,$proxypassword,$connectTimeOut,$readTimeOut);
        $client->setOutgoingEncoding("GBK");
        
        $reports = $client->getReport();
        //var_dump($reports);exit; 
        //测试
       /*  $reports = array(
            'errorCode' => 'DELIVRD',
            'memo' => '',
            'mobile' => '15824192179',
            'receiveDate' => '20160713101746',
            'reportStatus' => '0',
            'seqID' => '16',
            'serviceCodeAdd' => '',
            'submitDate' => '20160713101741'
        );        
        $reports = array(
            '0' => array(
                'errorCode' => 'DELIVRD',
                'memo' => '',
                'mobile' => '15824192179',
                'receiveDate' => '20160714101106',
                'reportStatus' => '0',
                'seqID' => '27',
                'serviceCodeAdd' => '',
                'submitDate' => '20160714101101'
            ),
            '1' => array(
                'errorCode' => 'DELIVRD',
                'memo' => '',
                'mobile' => '13735490544',
                'receiveDate' => '20160714101107',
                'reportStatus' => '0',
                'seqID' => '28',
                'serviceCodeAdd' => '',
                'submitDate' => '20160714101101'
            ),
            '2' => array(
                'errorCode' => 'DELIVRD',
                'memo' => '',
                'mobile' => '15824192179',
                'receiveDate' => '20160713101107',
                'reportStatus' => '0',
                'seqID' => '29',
                'serviceCodeAdd' => '',
                'submitDate' => '20160713101101'
            ),
            '3' => array(
                'errorCode' => 'DELIVRD',
                'memo' => '',
                'mobile' => '15824192179',
                'receiveDate' => '20160713101107',
                'reportStatus' => '0',
                'seqID' => '30',
                'serviceCodeAdd' => '',
                'submitDate' => '20160713101101'
            ),
            '4' => array(
                'errorCode' => 'DELIVRD',
                'memo' => '',
                'mobile' => '15824192179',
                'receiveDate' => '20160713101107',
                'reportStatus' => '0',
                'seqID' => '31',
                'serviceCodeAdd' => '',
                'submitDate' => '20160713101101'
            ),
        ); */
        
        $dim = $this->getmaxdim($reports);
        
        if($dim == 1)
        {
            //相关逻辑
            $sms_list_id = $reports['seqID'];
            
            $ci = &get_instance();
            
            $ci->load->driver('cache', array('adapter' => 'redis'));
            
            $ci->load->model('Smslist_model');
            
            //因为同一个短信账号不止这边在用，所以会获取到更多的短信报告内容，查询的时候为了匹配精确性，根据id和手机号并且没有入队3个条件查询
            $current_sms_list = $ci->Smslist_model->getRowByIdMobile($sms_list_id,$reports['mobile']);
            
            if(!empty($current_sms_list))
            {
                if($reports['reportStatus'] == 0)
                {
                    //短信接收结果（1用户正常收到短信；0未收到）
                    $msg['receive_result'] = 1;
                }else
                {
                    $msg['receive_result'] = 0;
                }
                
                $msg['receive_time'] = date('Y-m-d H:i:s', strtotime($reports['receiveDate']));
                
                $msg['report_msg'] = $reports['errorCode'];
                
                //序列化返回值存入这个字段中
                $msg['report_data'] = serialize($reports);
                
                //将对应的sms_list进行入队操作 存入一些smslist信息
                $smslist_queue = array(
                    'smslist_id' => $current_sms_list['id'],   
                    'client_ssid' => $current_sms_list['ssid'],
                    'mobile' => $current_sms_list['mobile'],
                    'receive_result' => $msg['receive_result'],//短信接收结果（1用户正常收到短信；0未收到）
                    'receive_time' => $msg['receive_time'],
                    'report_data' => $msg['report_data'],
                    'report_msg' => $msg['report_msg'],
                	'mer_id'=>$current_sms_list['mer_id']
                );
                
                $add_queue = $ci->cache->redis->LPUSH('smslist_queue', serialize($smslist_queue));
                
                if($add_queue)
                {
                    //入队成功
                    $msg['is_addqueue'] = 1;
                }else
                {
                    $msg['is_addqueue'] = 0;
                }
                
                $update_data = array(
                    'receive_result' => $msg['receive_result'],
                    'receive_time' => $msg['receive_time'],
                    'report_data' => $msg['report_data'], 
                    'report_msg' => $msg['report_msg'],
                    'is_addqueue' => $msg['is_addqueue']
                );
                
                $ci->db->where('id', $current_sms_list['id']);
                
                $update = $ci->db->update('sms_list', $update_data);  
                
                if(!$update)
                {
                    //记录错误信息到日志
                    //记录下日志
                    $redis_err = fopen('update_ym_sms_list_status_error.log', 'a');
                    fwrite($redis_err, '更新数据失败 相关信息 状态报告 sms_list_id : '.$current_sms_list['id'].'  receive_result:'.$msg['receive_result']." receive_time:".$msg['receive_time']." is_addqueue:".$msg['is_addqueue']." status_report :".serialize($reports)."\n" . date('Y-m-d H:i:s', time()) . "\n");
                    fclose($redis_err);
                }
            }
        }
        else if($dim == 2)
        {
            $ci = &get_instance();
            
            $ci->load->driver('cache', array('adapter' => 'redis'));
            
            $ci->load->model('Smslist_model');
            
            foreach($reports as $report)
            {
                $sms_list_id = $report['seqID'];
                
                $current_sms_list = $ci->Smslist_model->getRowByIdMobile($sms_list_id,$report['mobile']);
                
                if(!empty($current_sms_list))
                {
                    if($report['reportStatus'] == 0)
                    {
                        //短信接收结果（1用户正常收到短信；0未收到）
                        $msg['receive_result'] = 1;
                    }else
                    {
                        $msg['receive_result'] = 0;
                    }
                    
                    $msg['receive_time'] = date('Y-m-d H:i:s', strtotime($report['receiveDate']));                   
                    
                    $msg['report_msg'] = $report['errorCode'];
                    //序列化返回值存入这个字段中
                    $msg['report_data'] = serialize($report);
                    
                    //将对应的sms_list进行入队操作 存入一些smslist信息
                    $smslist_queue = array(
                        'smslist_id' => $current_sms_list['id'],
                        'client_ssid' => $current_sms_list['ssid'],
                        'mobile' => $current_sms_list['mobile'],
                        'receive_result' => $msg['receive_result'],//短信接收结果（1用户正常收到短信；0未收到）
                        'receive_time' => $msg['receive_time'],
                        'report_data' => $msg['report_data'],
                        'report_msg' => $msg['report_msg'],
                    	'mer_id'=>$current_sms_list['mer_id']
                    );
                    
                    $add_queue = $ci->cache->redis->LPUSH('smslist_queue', serialize($smslist_queue));
                    
                    if($add_queue)
                    {
                        //入队成功
                        $msg['is_addqueue'] = 1;
                    }else
                    {
                        $msg['is_addqueue'] = 0;
                    }
                    
                    $update_data = array(
                        'receive_result' => $msg['receive_result'],
                        'receive_time' => $msg['receive_time'],
                        'report_data' => $msg['report_data'],
                        'report_msg' => $msg['report_msg'],
                        'is_addqueue' => $msg['is_addqueue']
                    );
                    
                    $ci->db->where('id', $current_sms_list['id']);
                    
                    $update = $ci->db->update('sms_list', $update_data);
                    
                    if(!$update)
                    {
                        //记录错误信息到日志
                        //记录下日志
                        $redis_err = fopen('update_ym_sms_list_status_error.log', 'a');
                        fwrite($redis_err, '更新数据失败 相关信息 状态报告 sms_list_id : '.$current_sms_list['id'].'  receive_result:'.$msg['receive_result']." receive_time:".$msg['receive_time']." is_addqueue:".$msg['is_addqueue']." status_report :".serialize($report)."\n" . date('Y-m-d H:i:s', time()) . "\n");
                        fclose($redis_err);
                    }
                }
            }
        }
    }
    
    //可以判断是一维的,还是二维的,或是几维的数组:
    private function getmaxdim($arr){
    
        if(!is_array($arr)){
    
            return 0;
    
        }else{
    
            $dimension = 0;
    
            foreach($arr as $item1)  
            {
    
                $t1=$this->getmaxdim($item1);
    
                if($t1>$dimension){$dimension = $t1;}
    
            }
    
            return $dimension+1;
    
        }
    
    }
}
?>