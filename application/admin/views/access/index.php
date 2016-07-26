
<?php 
	$this->load->view('header.php');
?>

<script src="<?=base_url().'js/bootstrap-datetimepicker.js'?>"></script>
<script src="<?=base_url().'js/bootstrap-select.js'?>"></script>
<script src="<?=base_url().'js/bootstrap-switch.js'?>"></script>
<script src="<?=base_url().'js/highlight.js'?>"></script>
<script src="<?=base_url().'js/main.js'?>"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url().'css/bootstrap-select.css'?>"/>
<link rel="stylesheet" type="text/css" href="<?=base_url().'css/bootstrap-switch.css'?>"/>


<div class="container-fluid">
            <div class="row-fluid">
            	<div class="navbar">
	                <div class="navbar-inner">
			            <ul class="breadcrumb">
				            <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
				            <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
				            <li class="active">
				           	 	<a href="#">用户权限管理列表</a> <span class="divider">/</span>	
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
                                <div class="muted pull-left">用户权限管理列表</div>
                            </div>
                            <div class="block-content collapse in">
                            
                                                 
                                <form action="<?php echo site_url('access/update')?>" id="form1" method="post" style="margin-bottom:20px;text-align:center;margin:0 auto" class="form-horizontal" role="form" >
        			    		<?php if(!empty($access_list)){
        			    		foreach($access_list as $key => $value)
        			    		{
        			    			?>
        			    		
        			    		 <table class="table table-bordered table-striped" style="width: 30%;  float:left;margin-left:10px;">
        			    		   <tbody>
        			    		       <tr>
        			    		           <td><?php echo $value['name'];?></td>
        			    		       </tr>
        			    		       	<?php 
                		                 foreach ($value['node'] as $k => $v)
                		                 {
                		                      ?>
                		                      <tr>
            		                     		   <td>
            		                     		    <a href="javascript:void(0);" class="list-group-item"><?php echo $v['name']?>  
                            						  	<input class="role_access" type="checkbox" <?php if($v['node_auth'] == 1){?> checked=checked<?php }?> name="role_access[<?php echo $key;?>__<?php echo $v['action'];?>]">
                            						  </a>
            		                     		   </td>  
            		                     	</tr>                 
                		                       <?php 
                    		                   }
                    		              ?>  
     
        			    		   </tbody>    		 
        			    		 </table>  	
        			  		
        			  			<?php 
        			    		}
        			    	}?>     

        			    	<div style="clear: both"></div>
        			    	
        			    	<input type="hidden" name="role_id" value="<?php echo $role_id;?>" />
        			    	
        			    	 <div class="col-sm-12" style="text-align:center" >
        	                    <input type="submit" class="btn-primary btn"  name="submit" value="确定修改权限" >
        	                </div>
        			    </form>

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