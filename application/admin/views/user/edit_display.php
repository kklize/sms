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
				           	 	<a href="#">编辑用户信息</a> <span class="divider">/</span>	
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
                                <div class="muted pull-left">编辑用户信息</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                	<?php echo form_open('user/update',array('class'=>'form-horizontal')); ?>
                                    
                                      <fieldset>
                                        <legend>修改用户信息</legend>
                                       <div class="control-group">
                                	    <label for="focusedInput" class="col-sm-2 control-label">用户名</label>
                                	    <div class="controls">
                                	      <input type="text" value="<?php echo $current_user['adm_username']; ?>" class="form-control" name="adm_username" id="adm_username" placeholder="Username">
                                	    </div>
                                	  </div>
                                       <div class="control-group">
                                	    <label for="focusedInput" class="col-sm-2 control-label">密码</label>
                                	    <div class="controls">
                                	      <input type="text" value="<?php echo $current_user['adm_password']; ?>" class="form-control" name="adm_password" id="adm_password" placeholder="Password">	   		
                                	    </div>
                                	  </div>
                                	    <div class="control-group">
                                	    	 <label for="focusedInput" class="col-sm-2 control-label">所属角色</label>
                                	    	 <div class="controls">
                                	    	 	<select class="form-control" name="role_id">
                                	    	 		<option value=''>请选择</option>
                                	    	 		
                                	    	 		<?php if(!empty($all_roles))
                                	    	 				{
                                	    	 					foreach ($all_roles as $key => $value)
                                	    	 					{
                                	    	 						?>
                                	    	 						<option value="<?php echo $value['id'];?>" <?php if($current_user['role_id'] == $value['id']){?> selected <?php } ?>><?php echo $value['role_name'];?></option>
                                	    	 						
                                	    	 						<?php 
                                	    	 						
                                	    	 					}		
                                	    	 				}?>
                                	    	 		
                                	    	 	</select>
                                	    	 </div>
                                	    </div>
                                	  
                                	  <input type="hidden" value="<?php echo $current_user['id']?>" name="id" />
                                        

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">确定修改</button>
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