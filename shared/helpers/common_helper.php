<?php
if ( ! function_exists('echo_json')) {
	function echo_json($arr) {
		echo json_encode($arr);exit();
	}
}

if ( ! function_exists('merchant_validation')) {
	function merchant_validation($mer_name, $keycode) {
		$CI = &get_instance();
		$CI->load->model('Merchant_model');
		$merchant = $CI->Merchant_model->getByUsername($mer_name);
		if ( ! empty($merchant)) {
			$code = $merchant['apikey'].$merchant['apisecret'];
			if ($code == $keycode) {
				return array('code'=>'000','msg'=>'验证成功','mer_id'=>$merchant['id']);
			} else {
				return array('code'=>'002','msg'=>'密钥错误');
			}
		} else {
			return array('code'=>'001','msg'=>'不存在有效的商户号');
		}
	}
}

if ( ! function_exists('mobile_validation')) {
	function mobile_validation($mobile, $limit = 200) {
		if (count($mobile) > $limit) {
			return array('code'=>'005','msg'=> "每次最多只能发".$limit."个号码");
		}
		if (! empty($mobile)) {
			foreach ($mobile as $v) {
				$legal_mobile = preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $v);   //验证手机号为11位纯数字
				if( ! $legal_mobile){
					return array('code'=>'004','msg'=>'手机号格式错误');break;
				}
			}
			return array('code'=>'000','msg'=>'验证通过');
		}
		return 	array('code'=>'003','msg'=>'手机号不能为空');	
	}
}
