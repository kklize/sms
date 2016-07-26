
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
				           	 	<a href="#">所有角色列表</a> <span class="divider">/</span>	
				            </li>
			            </ul>
	                </div>
		      	</div>
                <div class="span12" id="content">
                    
                   <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">所有角色列表</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     <a class="pull-right panel-title" href="javascript:void(0);" style="display:block;text-decoration:none"> 
                                    	<input type="button" class="btn-sm btn-primary btn" value="添加角色类型" id="add_role">
                                    </a>
                
                                
  									<table class="table">
						              <thead>
						               <tr>
                                         	<th>
                                     			编号
                                     		</th>
                                     		<th>
                                     			角色名称
                                     		</th>
                                     		<th>
                                     			操作
                                     		</th>
                                     	</tr>
						              </thead>
						              <tbody>
						           <?php 
                                     		if(!empty($result))
                                     		{
                                     			foreach ($result as $key => $value)
                                     			{
                                     				?>
                                     				<tr>
                                     					<td>
                                     						<?php echo $value['id'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['role_name'];?>
                                     				</td>				
                                     					<td>
                                     						<a href="<?php echo site_url('access/index?id='.$value['id']);?>">
                                     							设置权限	
                                     						</a>
                                     						
                                     					</td>
                                     				</tr>
                                     				<?php 
                                     			}
                                     		}
                                     	?>
						              </tbody>
						            </table>

    						             <div class="span6">						            
        						            <div class="dataTables_paginate paging_bootstrap pagination">
        						                <ul>
                                              	 <?php echo $page;?>
                                              	</ul>
        						            </div>
    						            </div>					           
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
        <script>
    	$(function(){
    		$('#add_role').click(function(){
    			window.location.href = "/admin/index.php/access/add_access";
    		});
    	});
     </script>
       <script src="<?=base_url().'bootstrap/js/bootstrap.min.js'?>"></script>
</body>
</html>