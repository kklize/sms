<?php 
	$this->load->view('header.php');
?>
<div class="container-fluid">
            <div class="row-fluid">
            	<div class="navbar">
	                <div class="navbar-inner">
			            <ul class="breadcrumb">
				            <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
				            <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
				            <li class="active">
				           	 	<a href="<?php echo site_url("sms/index")?>">短信接口列表</a> <span class="divider">/</span><a href="#">新增短信接口</a>	
				            </li>
			            </ul>
	                </div>
		      	</div>
                <div class="span12" id="content">
                      <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">新增短信接口</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                	<div class="alert alert-success hide">
										<button class="close" type="button" data-dismiss="alert">×</button>
		                            	<strong>操作成功</strong>
		                            </div>
		                            <div class="alert alert-error hide">
										<button class="close" data-dismiss="alert">×</button>
										<strong>操作失败</strong><span></span>
									</div>
                                     <form class="form-horizontal" action="<?php echo site_url("sms/add")?>" id="sms_form" method="post">
                                      <fieldset>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">接口名称</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" id="name" name="name" type="text" palceholder="接口名称">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">接口类名</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" id="class_name" name="class_name" type="text" palceholder="接口类名">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">接口描述</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" id="description" name="description" palceholder="接口描述"></textarea>
                                          </div>
                                        </div>
                                        <div class="form-actions">
                                          <button type="button" class="btn btn-primary save">保存</button>
                                          <button type="reset" class="btn">取消</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <hr>
            <footer>
                <p>&copy; Vincent Gabriel 2013</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <link href="<?=base_url().'vendors/datepicker.css'?>" rel="stylesheet" media="screen">
        <link href="<?=base_url().'vendors/uniform.default.css'?>" rel="stylesheet" media="screen">
        <link href="<?=base_url().'vendors/chosen.min.css'?>" rel="stylesheet" media="screen">

        <link href="<?=base_url().'vendors/wysiwyg/bootstrap-wysihtml5.css'?>" rel="stylesheet" media="screen">

        <script src="<?=base_url().'vendors/jquery-1.9.1.js'?>"></script>
        <script src="<?=base_url().'bootstrap/js/bootstrap.min.js'?>"></script>
        <script src="<?=base_url().'vendors/jquery.uniform.min.js'?>"></script>
        <script src="<?=base_url().'vendors/chosen.jquery.min.js'?>"></script>
        <script src="<?=base_url().'vendors/bootstrap-datepicker.js'?>"></script>

        <script src="<?=base_url().'vendors/wysiwyg/wysihtml5-0.3.0.js'?>"></script>
        <script src="<?=base_url().'vendors/wysiwyg/bootstrap-wysihtml5.js'?>"></script>

        <script src="<?=base_url().'vendors/wizard/jquery.bootstrap.wizard.min.js'?>"></script>

	<script type="text/javascript" src="<?=base_url().'vendors/jquery-validation/dist/jquery.validate.min.js'?>"></script>
	<script src="<?=base_url().'js/validation.js'?>"></script>
        
	<script src="<?=base_url().'js/scripts.js'?>"></script>
        <script>
			$(".save").on('click', function(){
				$.ajax({
					url:"<?php echo site_url("sms/add")?>",
					type:'post',
					dataType: 'json',
					data:$("#sms_form").serialize(),
					success:function(obj){
						if(obj[0] == 'success'){
							$(".alert-success").show();
						}else{
							$(".alert-error").show();
							$(".alert-error span").html(obj[1]);
						}

						setTimeout(function(){
							$(".alert").hide();
							if(obj[0] == 'success'){
								window.location.href = "<?php echo site_url("sms/index")?>";
							}
						},2000);
					}
				})
			})  
        </script>
</body>
</html>