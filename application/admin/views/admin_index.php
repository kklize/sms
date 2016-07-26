<!DOCTYPE html>
<html>
  <head>
    <title>管理员登录</title>
    <!-- Bootstrap -->
    <link href="<?=base_url().'bootstrap/css/bootstrap.min.css'?>" rel="stylesheet" media="screen">
		<link href="<?=base_url().'bootstrap/css/bootstrap-responsive.min.css'?>" rel="stylesheet" media="screen">
		<link href="<?=base_url().'assets/css/styles.css'?>" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?=base_url().'vendors/modernizr-2.6.2-respond-1.1.0.min.js'?>"></script>
  </head>
  <body id="login">
    <div class="container">
    <?php if (isset($err) && !empty($err)){?>
    <div class="alert alert-error">
		<button class="close" data-dismiss="alert">×</button>
		<strong>登录失败 </strong><?php echo $err;?>
	</div>
	<?php }?>
      <form class="form-signin" action="<?php echo site_url("admin/index")?>" id="login_form" method="post">
        <h2 class="form-signin-heading">后台管理系统登录</h2>
        <input type="text" value="<?php echo set_value('adm_username'); ?>" class="input-block-level" name="adm_username" id="adm_username" placeholder="用户名">
        <input type="password" class="input-block-level" name="adm_password" id="adm_password" placeholder="密码" >
        <label class="checkbox">
          <input type="checkbox" value="remember" name="remember"> 记住我
        </label>
        <button class="btn btn-large btn-primary" type="submit">登录</button>
      </form>

    </div> <!-- /container -->
    <script src="<?=base_url().'vendors/jquery-1.9.1.min.js';?>"></script>
    <script src="<?=base_url().'bootstrap/js/bootstrap.min.js';?>"></script>
    
  </body>
</html>