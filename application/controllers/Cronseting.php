<?php
class Cronseting extends CI_Controller
{
    public function cronset()
    {
        if(!isset($_SERVER['SERVER_PROTOCOL'])) 
        {
            //仅命令行能访问 用于统一设置cron
            date_default_timezone_set('Asia/Shanghai');
            
            $now = time();
            $ymd = date('Y-m-d',$now);
            $day = date('N',$now);
            $hour = date('H',$now);
            $minute = date('i',$now);
            $second = date('s',$now);
            $week = date('D',$now);
            
            
            $phpcmd = exec("which php");
            
            //每N分钟执行一次 队列任务
            if($minute % 1 == 0)
            {
                $cmd = $phpcmd." index.php cronseting getstatuReport";
                system($cmd);
            }
        }else
        {
           echo '浏览器无效';exit;   
        }       
    }
    
    //获取短信状态报告
    public function getstatuReport()
    {
        $redis_err = fopen('report_status_do.log', 'a');
        fwrite($redis_err, '运行 ' . date('Y-m-d H:i:s', time()) . "\n");
        fclose($redis_err);
        
        $this->load->library('do_sms');
        
        $do_sms = new do_sms();
        
        $do_sms->getStatusReport();
    }
}
?>