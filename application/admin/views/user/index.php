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
				           	 	<a href="#">用户列表</a> <span class="divider">/</span>	
				            </li>
			            </ul>
	                </div>
		      	</div>
                <div class="span12" id="content">
                   <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">用户列表</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  									<table class="table">
						              <thead>
						               <tr>
                                     		<th>
                                     			编号
                                     		</th>
                                     		<th>
                                     			用户名
                                     		</th>
                                     		<th>
                                     			密码
                                     		</th>
                                     		<th>
                                     			所属权限
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
                                     						<?php echo $value['adm_username'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['adm_password'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['role_name'];?>
                                     					</td>
                                     					<td>
                                     						<a href="<?php echo site_url('user/edit_display?id='.$value['id']);?>">
                                     							编辑
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
        
          
        <script src="<?=base_url().'bootstrap/js/bootstrap.min.js'?>"></script>
      
</body>
</html>
