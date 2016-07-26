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
				           	 	<a href="#">添加商户</a> <span class="divider">/</span>	
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
                                <div class="muted pull-left">添加商户</div>
                            </div>
                            <?php if (isset($err) && !empty($err)){?>
						    <div class="alert alert-error">
								<?php echo $err;?>
							</div>
							<?php }?>
                            <div class="block-content collapse in">
                                <div class="span12">
                                	<?php echo form_open('merchant/add',array('class'=>'form-horizontal')); ?>
                                    
                                      <fieldset>
                                        <legend>添加商户</legend>
                                       <div class="control-group">
                                	    <label for="focusedInput" class="col-sm-2 control-label">鉴权账号</label>
                                	    <div class="controls">
                                	      <input type="text" value="<?php if(!empty($current_merchant)) echo $current_merchant['apikey']; ?>" class="form-control" name="apikey" id="apikey" placeholder="Apikey">
                                	    </div>
                                	   </div>
                                	   
                                       <div class="control-group">
                                	    <label for="focusedInput" class="col-sm-2 control-label">商户全称</label>
                                	    <div class="controls">
                                	      <input type="text" value="<?php if(!empty($current_merchant)) echo $current_merchant['name']; ?>" class="form-control" name="name" id="name" placeholder="Name">	   		
                                	    </div>
                                	   </div>
                                	   
                                	   <div class="control-group">
                                	    <label for="focusedInput" class="col-sm-2 control-label">商户用户名</label>
                                	    <div class="controls">
                                	      <input type="text" value="<?php if(!empty($current_merchant)) echo $current_merchant['user_name']; ?>" class="form-control" name="user_name" id="user_name" placeholder="User_name">	   		
                                	    </div>
                                	   </div>
                                	   
                                	   <div class="control-group">
                                	    <label for="focusedInput" class="col-sm-2 control-label">商户联系方式</label>
                                	    <div class="controls">
                                	      <input type="text" value="<?php if(!empty($current_merchant)) echo $current_merchant['mobile']; ?>" class="form-control" name="mobile" id="mobile" placeholder="Mobile" maxlength='11'>	   		
                                	    </div>
                                	   </div>
                                	   
                                	   <div class="control-group">
                                	    <label for="focusedInput" class="col-sm-2 control-label">鉴权密码</label>
                                	    <div class="controls">
                                	      <input type="text" value="<?php if(!empty($current_merchant)) echo $current_merchant['apisecret']; ?>" class="form-control" name="apisecret" id="apisecret" placeholder="Apisecret">	   		
                                	    </div>
                                	   </div>
                                	   
                                	   <div class="control-group">
                                	    <label for="focusedInput" class="col-sm-2 control-label">相关描述</label>
                                	    <div class="controls">
                                	      <input type="text" value="<?php if(!empty($current_merchant)) echo $current_merchant['description']; ?>" class="form-control" name="description" id="description" placeholder="Description">	   		
                                	    </div>
                                	   </div>
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">确定添加</button>
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
        
          <script src="<?=base_url().'bootstrap/js/bootstrap.min.js'?>"></script>
</body>
</html>