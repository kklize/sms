<?php
//返回所有的模块名及方法名

return array(
		"user" => array(
			"name" => "用户管理"	,
			"node" => array(
				"index" => array(
					"name" => "用户信息","action" => "index"		
				),
				"edit_display" => array(
					"name" => "编辑用户页面","action" => "edit_display","belong" => "admin"		
				),	
				"update" => array(
						"name" => "编辑按钮","action" => "update","belong" => "admin"
				),
			)
		),
		"access" => array(
			"name" => "角色管理"	,
			"node" => array(
					"role_list" => array(
							"name" => "角色信息","action" => "role_list"
					),
					"index" => array(
							"name" => "角色权限编辑页面","action" => "index","belong" => "admin"
					),
					"update" => array(
							"name" => "角色权限编辑操作","action" => "update","belong" => "admin"
					),
					"add_access" => array(
							"name" => "角色添加","action" => "add_access","belong" => "admin"		
					),
			)
		),
		"smslist" => array(
			"name" => "短信详情管理"	,
			"node" => array(
				"index" => array(
					"name" => "短信详情页面","action" => "index","belong" => "admin"
				),
			)
		),
		"sms" => array(
				"name" => "短信接口管理",
				"node" => array(
						"index"=>array(
								"name" => "短信接口列表", "action"=>"index"
						),
						"add" => array(
								"name" => "短信接口新增", "action"=>"add","belong" => "admin"
						),
						"edit" => array(
								"name" => "短信接口编辑", "action"=>"edit","belong" => "admin"
						),
						"effect"=>array(
								"name" => "短信接口启用","action"=>"effect"
						),
						"invalid"=>array(
								"name"=>"短信接口卸载","action"=>"invalid"
						)
				)
		),

		"merchant" => array(
				"name" => "商户管理"	,
				"node" => array(
						"index" => array(
								"name" => "商户信息","action" => "index"
						),
						"add_display" => array(
								"name" => "商户添加页面","action" => "add_display","belong" => "admin"
						),
						"add" => array(
								"name" => "商户添加操作","action" => "add","belong" => "admin"
						),
						"edit_display" => array(
								"name" => "商户编辑页面","action" => "edit_display","belong" => "admin"
						),
						"update" => array(
								"name" => "商户编辑操作","action" => "update","belong" => "admin"
						),
						"delete" => array(
								"name" => "商户删除操作","action" => "delete","belong" => "admin"
						),
				)
		),
		"report" => array(
			"name" => "短信报告管理"	,
			"node" => array(
				"index" => array(
					"name" => "短信报告页面","action" => "index","belong" => "admin"
				),
			)
		),

);