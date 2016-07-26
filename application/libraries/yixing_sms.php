<?php
/*
 默认配置 短信接口 使用方式
 $this->load->library('yixing_sms');
 $test = new yixing_sms();
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once SHARED_PATH.'sms/sms.php';  //引入接口
require_once SHARED_PATH."sms/YiXing/SendMobileMessage.php";
class yixing_sms implements sms
{	
	public function sendSMS($mobile_number,$content,$smsID)
	{			
		/*调用宜信接口发送短信*/
		$sendMobile = new SendMobileMessage();
		
		$sendReturnMessage = $sendMobile->sendmessage($mobile_number['0'],$content,$smsID);
        
		$result['send_data'] = serialize($sendReturnMessage);
		
		if(!empty($sendReturnMessage) && $sendReturnMessage->status == 0)
		{/*接口的响应 状态0代表已响应*/
			$result['status'] = 1;
			$result['msg'] = '发送成功';
			$result['class_name'] = 'yixing_sms';
		}else
		{
			$result['status'] = 0;
			$result['msg'] = '发送失败';
			$result['class_name'] = 'yixing_sms';
		}	

		return $result;
	}
	
	public function getStatusReport()
	{
		/*调用宜信接口获取report*/
		$sendMobile = new SendMobileMessage();
		
		$report = $sendMobile->getReport();

		if(!empty($report->data))
		{
		    $ci = &get_instance();
		    
		    $ci->load->driver('cache', array('adapter' => 'redis'));
		    
		    $ci->load->model('Smslist_model');
		    
			/*遍历反馈的状态报告*/
			foreach ($report->data as $key => $value)
			{
			    $reports = array(
			        'status' => $value->status,
			        'ssid' => $value->ssid,
			        'mobile' => $value->mobile,
			        'errorcode' => $value->errorcode,
			        'pktotal' => $value->pktotal,
			        'pknumber' => $value->pknumber,
			        'custom' => $value->custom
			    );
			    
			    
			    $sms_list_id = $reports['ssid'];
			    
			    //因为同一个短信账号不止这边在用，所以会获取到更多的短信报告内容，查询的时候为了匹配精确性，根据id和手机号2个条件查询
			    $current_sms_list = $ci->Smslist_model->getRowByIdMobile($sms_list_id,$reports['mobile']);
			    
			    if(!empty($current_sms_list))
			    {
			        if($reports['status'] == 0)
			        {
			            //短信接收结果（1用户正常收到短信；0未收到）
			            $msg['receive_result'] = 1;
			        }else
			        {
			            $msg['receive_result'] = 0;
			        }
			        
			        $msg['receive_time'] = date('Y-m-d H:i:s', time());
			        
			        
			        $msg['report_msg'] = $reports['errorcode'];
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
			            $redis_err = fopen('update_yixing_sms_list_status_error.log', 'a');
			            fwrite($redis_err, '更新数据失败 相关信息 状态报告 sms_list_id : '.$current_sms_list['id'].'  receive_result:'.$msg['receive_result']." receive_time:".$msg['receive_time']." is_addqueue:".$msg['is_addqueue']." status_report :".serialize($reports)."\n" . date('Y-m-d H:i:s', time()) . "\n");
			            fclose($redis_err);
			        }
			    }	
			}			
		}
	}
}

?>