<?php
/*
 * cli 模式发送短信
 * php index.php(文件所在路径) command_send_message send_message
 */
class Command_send_message extends CI_Controller
{

    public function send_message()
    {
        $this->load->model('Smslist_model');

        $this->load->library('do_sms');
        
        $do_sms = new do_sms(); 

        $this->load->driver('cache', array(
            'adapter' => 'redis'
        ));
        
        $supported = $this->cache->redis->is_supported();
        
        if ($supported) {
            $i = 10;
            
            while ($i > 0) {
                $seal = $this->cache->redis->RPOP('send_message_list');
                
                if (! empty($seal)) 
                {
                    $arr = unserialize($seal);
                    
                    $mobile_array = $arr['mobile'];
                    
                    $content = $arr['content'];
                    
                    $mer_id = $arr['mer_id'];
                    
                    $business_type = $arr['business_type'];
                    
                    $ssid = $arr['ssid'];
                    
                    if (! empty($mobile_array)) 
                    {
                        foreach ($mobile_array as $key => $value) 
                        {
                            // 插入数据和发送短信相关逻辑
                            $insert_date = array(
                                'mobile' => $value,
                                'content' => $content,
                                'mer_id' => $mer_id,
                                'ssid' => $ssid,
                                'business_type' => $business_type
                            );
                            
                            
                            $smslist_id = $this->Smslist_model->insert($insert_date);
                            
                            if ($smslist_id === false) 
                            {
                               //记录下日志
                                $redis_err = fopen('insert_sms_list_error.log', 'a');
                                fwrite($redis_err, '插入数据失败 相关信息  mobile:'.$value." mer_id:".$mer_id." ssid:".$ssid." \n content :".$content."\n" . date('Y-m-d H:i:s', time()) . "\n");
                                fclose($redis_err);
                            }else
                            {
                            
                                // 发送短信 逻辑  $result 只有1代表发送成功，其他都为失败                            
                                $result = $do_sms->sendSMS($value, $content, $smslist_id);
                                
                                // 更新message信息
                                if($result['status'] == 1)
                                {
                                    $send_status = 1;//是否已发送（0，未发送，1已发送）
                                    $send_result = 1;//发送结果(0.发送失败，1发送成功)
                                }else
                                {
                                    $send_status = 0;//是否已发送（0，未发送，1已发送）
                                    $send_result = 0;//发送结果(0.发送失败，1发送成功)
                                }
                                
                                $update_data = array(
                                    'send_status' => $send_status, 
                                    'send_result' => $send_result, 
                                    'send_data' => $result['send_data'], // 短信接口返回值
                                    'send_msg' => $result['msg'],
                                    'send_time' => date('Y-m-d H:i:s', time()),
                                    'sms_class' => $result['class_name']
                                );
                                // 短信接口类型
                                
                                $this->db->where('id', $smslist_id);
                                $update = $this->db->update('sms_list', $update_data);
                                
                                if(!$update)
                                {
                                    //记录下日志
                                    $redis_err = fopen('update_sms_list_error.log', 'a');
                                    fwrite($redis_err, '更新数据失败 相关信息 sms_list_id : '.$smslist_id.'  mobile:'.$value." mer_id:".$mer_id." ssid:".$ssid." \n content :".$content."\n" . date('Y-m-d H:i:s', time()) . "\n");
                                    fclose($redis_err);
                                }
                            }
                        }
                    }
                }
                
                sleep(rand() % 3);
                
                $i --;
            }
        } else {
            // 不支持 redis 写入内容到error_log 里面
            
            $redis_err = fopen('redis_error.log', 'a');
            fwrite($redis_err, '系统环境不支持redis ' . date('Y-m-d H:i:s', time()) . "\n");
            fclose($redis_err);
        }
    }
    
    //生成客户获取状态报告数据
    public function get_status_report()
    {
        $this->load->driver('cache', array(
            'adapter' => 'redis'
        ));
        
        $supported = $this->cache->redis->is_supported();
        
        $this->load->model('Smsreport_model');
        
        if ($supported)
        {
            $i = 10;
            
            while ($i > 0) 
            {
                $seal = $this->cache->redis->RPOP('smslist_queue');
                
                if (! empty($seal))
                {
                    $arr = unserialize($seal);
                    
                    $receive_result = $arr['receive_result'];
                    
                    $mobile = $arr['mobile'];
                    
                    $sms_list_id = $arr['smslist_id'];
                    
                    $ssid = $arr['client_ssid'];
                    
                    $mer_id = $arr['mer_id'];
                    //只有收到短信的时候才有接收时间
                    if($receive_result == 1)
                    {
                        $receive_time = $arr['receive_time'];
                    }else
                    {
                        $receive_time = '';
                    }
                    
                    $report_data = $arr['report_data'];
                    
                    $report_msg = $arr['report_msg'];
                    
                    $insert_data = array(
                        'receive_result' => $receive_result,
                        'receive_time' => $receive_time,
                        'report_data' => $report_data,
                        'report_msg' => $report_msg,
                        'ssid' => $ssid,
                        'sms_list_id' => $sms_list_id,
                        'mobile' => $mobile,
                    	'mer_id' => $mer_id
                    );
                    
                    
                    
                    $insert  = $this->Smsreport_model->insert($insert_data);
                    
                }
                
                sleep(rand() % 3);
                
                $i --;
            }
        }
    }
}
?>