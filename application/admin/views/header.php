<!DOCTYPE html>
<html>
    <head>
        <title>后台管理系统</title>
        <!-- Bootstrap -->
		<link href="<?=base_url().'bootstrap/css/bootstrap.min.css'?>" rel="stylesheet" media="screen">
		<link href="<?=base_url().'bootstrap/css/bootstrap-responsive.min.css'?>" rel="stylesheet" media="screen">
		<link href="<?=base_url().'assets/css/styles.css'?>" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?=base_url().'vendors/jquery-1.9.1.js'?>"></script>
        <script src="<?=base_url().'assets/js/scripts.js'?>"></script>
        <script src="<?=base_url().'vendors/modernizr-2.6.2-respond-1.1.0.min.js'?>"></script>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">同牛科技短信系统</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo $this->session->adm_username; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url("admin/logout"); ?>">退出</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <input type="hidden" value="<?php echo $this->uri->segment(1);?>" id="postion_url" />
                        <ul class="nav">
                            <li>
                                <a href="<?php echo site_url("user/index"); ?>" data_url="user" class="daohang_url">用户列表</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("access/role_list"); ?>" data_url="access" class="daohang_url">权限管理</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("smslist/index"); ?>" data_url="smslist" class="daohang_url">短信详情管理</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("merchant/index"); ?>" data_url="merchant" class="daohang_url">商户管理</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("sms/index"); ?>" data_url="sms" class="daohang_url">短信接口管理</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("report/index"); ?>" data_url="report" class="daohang_url">短信报告管理</a>
                            </li>
                        </ul>
                        
                        <script>
							$(function(){
								var current_url = $('#postion_url').val();
								$('.daohang_url').each(function(i,text){
									var daohang_url = $(this).attr('data_url');

									if(daohang_url == current_url)
									{
										$(this).parents('li').addClass('active');
										return false;
									}
								});
							});
                        </script>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>