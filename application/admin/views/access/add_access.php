
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
				           	 	<a href="#">添加角色</a> <span class="divider">/</span>	
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
                                <div class="muted pull-left">添加角色</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                	 <?php echo form_open('access/add_access',array('class'=>'form-horizontal')); ?>
                                    
                                      <fieldset>
                                        <legend>添加角色</legend>
                                       <div class="control-group">
                                	    <label for="focusedInput" class="col-sm-2 control-label">角色名称</label>
                                	    <div class="controls">
                                	     <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Role_name">
	   		                              <span style="color:red;"><?php echo form_error('role_name');?></span>
                                	    </div>
                                	  </div>
                                      
                                	
                                     
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