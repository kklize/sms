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
				           	 	<a href="#">商户列表</a> <span class="divider">/</span>	
				            </li>
			            </ul>
	                </div>
		      	</div>
                <div class="span12" id="content">
                	
                   <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">商户列表</div>
                                <a class="pull-right panel-title" href="javascript:void(0);" style="display:block;text-decoration:none"> 
                                    	<input type="button" class="btn-sm btn-primary btn" value="添加商户" id="add_merchant">
                                </a>
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
                                     			商户全称
                                     		</th>
                                     		<th>
                                     			商户用户名
                                     		</th>
                                     		<th>
                                     			商户联系方式
                                     		</th>
                                     		<th>
                                     			鉴权账号
                                     		</th>
                                     		<th>
                                     			鉴权密码
                                     		</th>
                                     		<th>
                                     			描述
                                     		</th>
                                     		<th>
                                     			创建时间
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
                                     						<?php echo $value['name'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['user_name'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['mobile'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['apikey'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['apisecret'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['description'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['create_time'];?>
                                     					</td>
                                     					<td>
                                     						<input type="hidden" value="<?php echo $value['apikey'];?>" id="protype<?php echo $value['apikey'];?>"/>
                                     						<a href="<?php echo site_url('merchant/edit_display?apikey='.$value['apikey']);?>">
                                     							编辑
                                     						</a>/
                                     						<a href="javascript:void(0)" class="delete_btn ib" data_apikey="<?php echo $value['apikey'];?>">
                                     							删除
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
	    		$('#add_merchant').click(function(){
	    			window.location.href = "/admin/index.php/merchant/add_display";
	    		});
	    	});

	    	$('.ib').click(function(e){
	    		var index = $.inArray(this,$('.ib'));
	    		var data_apikey = $('.ib').eq(index).attr('data_apikey');
	    		if (confirm("确定删除吗？")) {  
	    			window.location.href = "/admin/index.php/merchant/delete?apikey="+data_apikey; 
	            } 
	    	});
     	</script>
          
        <script src="<?=base_url().'bootstrap/js/bootstrap.min.js'?>"></script>
      	
</body>
</html>
	