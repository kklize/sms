<?php
	require_once SHARED_PATH."sms/YiXing/yiconfig.php";
	class SendMobileMessage {
		public function sendmessage($number, $verify_code , $smsID) 
		{
			header("Content-type: text/html; charset=utf-8");			
			if(empty($number) || empty($verify_code)) {
				return false;
			}			
			
			$arr = include("yiconfig.php");
						
			$url = $arr['send_url'];
			
			$cid = $arr['clientid'];
			
			$password = $arr['password'];
			
			$productid = $arr['productid'];
			
			$lcode = '';
			
			$ssid = $smsID;
			
			$format = 32;
			
			$sign = '';
			
			$content = $verify_code."退订回TD".$sign;
			
			$custom = '';
			
			$curl_url = $url.'?cid='.base64_encode(urlencode($cid)).'&pwd='.base64_encode(urlencode($password)).'&productid='
			.$productid.'&mobile='.base64_encode(urlencode($number)).'&content='.base64_encode(urlencode($content))
			.'&lcode='.$lcode.'&ssid='.$ssid.'&format='.$format.'&custom='.$custom;
			
			
			$return_arr = $this->curl_Nav($curl_url);			

			return $return_arr;
			
		}
		
		public function getReport()
		{/*获取发送短信的报告数据*/
			$arr = include("yiconfig.php");		
			
			$url = $arr['report_url'];
				
			$cid = $arr['clientid'];
				
			$password = $arr['password'];
			
			$curl_url = $url.'?cid='.base64_encode($cid).'&pwd='.base64_encode($password);
			
			$return_arr = $this->curl_Nav($curl_url);				
			//print_r($return_arr);
			return $return_arr;
		}	
		
		public function getDeliver()
		{
			$arr = include("yiconfig.php");
				
			$url = $arr['delivers_url'];
			
			$cid = $arr['clientid'];
			
			$password = $arr['password'];
				
			$curl_url = $url.'?cid='.base64_encode($cid).'&pwd='.base64_encode($password);
				
			$return_arr = $this->curl_Nav($curl_url);			
			//print_r($return_arr);
			return $return_arr;
		}

		public function curl_Nav($url)
		{
			$ch = curl_init();
			
			$this_header = array(
					"content-type: application/x-www-form-urlencoded;charset=UTF-8"
			);
			
			curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$output = curl_exec($ch);
			curl_close($ch);

			$phpArr = json_decode($output);
			
			return $phpArr;
		}
	}
?>