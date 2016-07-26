<?php 
	$this->load->view('header.php');
?>
<script type="text/javascript">
	$(function () {
		$('#start_receive_time').datetimepicker({
			format: 'yyyy-mm-dd hh:ii:ss',
			startView:1
		});
		$('#end_receive_time').datetimepicker({
			format: 'yyyy-mm-dd hh:ii:ss',
			startView:1
		});
	});

	function search(){
		var mobile = $('#mobile').val();
		var mer_id = $('#mer_id').val();
		var ssid = $('#ssid').val();
		var is_show = $('#is_show').val();
		var receive_result = $('#receive_result').val();
		var sms_list_id = $('#sms_list_id').val();
		var report_msg = $('#report_msg').val();
		var start_receive_time = $('#start_receive_time').val();
		var end_receive_time = $('#end_receive_time').val();
		window.location.href="/admin/index.php/report/index?mobile="+mobile+"&mer_id="+mer_id+"&ssid="+ssid+"&is_show="+is_show+"&receive_result="+receive_result+"&sms_list_id="+sms_list_id+"&report_msg="+report_msg+"&start_receive_time="+start_receive_time+"&end_receive_time="+end_receive_time;
	}
</script>
<div class="container-fluid">
            <div class="row-fluid">
            	<div class="navbar">
	                <div class="navbar-inner">
			            <ul class="breadcrumb">
				            <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
				            <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
				            <li class="active">
				           	 	<a href="#">短信报告列表</a> <span class="divider">/</span>
				            </li>
			            </ul>
	                </div>
		      	</div>
				<div class="navbar">
					<div class="navbar-inner">
						<span style="float:left;">
						<label>手机号</label>
							<input type="text" class="form-control" name="mobile" id="mobile" value="<?=empty($_GET['mobile'])?'':$_GET['mobile']?>">
						</span>
						<span style="float:left;margin-left:10px">
						<label>商户号</label>
							<input type="text" class="form-control" name="mer_id" id="mer_id" maxlength="11" style="width:80px" value="<?=empty($_GET['mer_id'])?'':$_GET['mer_id']?>">
						</span>
						<span style="float:left;margin-left:10px">
						<label>流水号</label>
							<input type="text" class="form-control" name="ssid" id="ssid" maxlength="18" style="width:140px" value="<?=empty($_GET['ssid'])?'':$_GET['ssid']?>">
						</span>
						<span style="float:left;margin-left:10px">
						<label for="send_status">是否被商户端调用</label>
						  <select class="form-control" name="is_show" id="is_show" style="width:80px">
							  <option value="-1" <?php if(!empty($_GET['is_show']) || isset($_GET['is_show'])){echo $_GET['is_show']==-1?'selected = "selected"':'';}?>>所有</option>
							  <option value="0"  <?php if(!empty($_GET['is_show']) || isset($_GET['is_show'])){echo $_GET['is_show']==0?'selected = "selected"':'';}?>>未调用</option>
							  <option value="1"  <?php if(!empty($_GET['is_show']) || isset($_GET['is_show'])){echo $_GET['is_show']==1?'selected = "selected"':'';}?>>已调用</option>
						  </select>
						</span>
						<span style="float:left;margin-left:10px">
						<label for="receive_result">短信接收结果</label>
						  <select class="form-control" name="receive_result" id="receive_result" style="width:80px">
							  <option value="-1" <?php if(!empty($_GET['receive_result']) || isset($_GET['receive_result'])){echo $_GET['receive_result']==-1?'selected = "selected"':'';}?>>所有</option>
							  <option value="0"  <?php if(!empty($_GET['receive_result']) || isset($_GET['receive_result'])){echo $_GET['receive_result']==0?'selected = "selected"':'';}?>>未收到</option>
							  <option value="1"  <?php if(!empty($_GET['receive_result']) || isset($_GET['receive_result'])){echo $_GET['receive_result']==1?'selected = "selected"':'';}?>>收到</option>
						  </select>
						</span>
						<span style="float:left;margin-left:10px">
						<label>短信列表序列号</label>
							<input type="text" class="form-control" name="sms_list_id" id="sms_list_id" maxlength="18" style="width:140px" value="<?=empty($_GET['sms_list_id'])?'':$_GET['sms_list_id']?>">
						</span>
						<span style="float:left;margin-left:10px">
						<label>错误信息</label>
							<input type="text" class="form-control" name="report_msg" id="report_msg" maxlength="18" style="width:140px" value="<?=empty($_GET['report_msg'])?'':$_GET['report_msg']?>">
						</span>
						<span style="float:left;margin-left:10px">
							<label>短信接收时间</label>
							开始时间<input type="text" class="form-control" name="start_receive_time" id="start_receive_time" value="<?=empty($_GET['start_receive_time'])?'':$_GET['start_receive_time']?>">
							结束时间<input type="text" class="form-control" name="end_receive_time" id="end_receive_time" value="<?=empty($_GET['end_receive_time'])?'':$_GET['end_receive_time']?>">
						</span>
						<span style="float:left;margin-left:10px;margin-top:19px">
						<button type="submit" class="btn btn-primary" onclick="search()">搜索</button>
						</span>
					</div>
				</div>

                <div class="span12" id="content">
                   <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">短信列表</div>
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
												短信接收结果
											</th>
											<th>
												短信接收时间
											</th>
											<th>
												状态报告
											</th>
											<th>
												错误信息
											</th>
											<th>
												流水号
											</th>
											<th>
												短信列表序列号
											</th>
											<th>
												是否被商户端调用
											</th>
											<th>
												手机号
											</th>
										   <th>
											   商户号
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
                                     						<?php echo $value['receive_result']==0?'未收到':'收到';?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['receive_time'];?>
                                     					</td>
                                     					<td>
															<input class="btn btn-primary" id="btntext" type="button" value="显示" data-toggle="modal" data-target="#myModal<?=$value['id']?>"  href=""/>
															<div class="modal hide fade" id="myModal<?=$value['id']?>" tabindex="-1" role="dialog">
																<div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
																	<h3 id="myModalLabel">状态报告<?=$value['id']?></h3>
																</div>
																<div class="modal-body">
																	<?php
																		if(!empty($value['report_data']))
																		{
																			foreach(unserialize($value['report_data']) as $k=>$v){
																				echo $k.'='.$v.'<br>';
																			}
																		}
																	?>
																</div>
															</div>
                                     					</td>
														<td>
															<?php echo $value['report_msg'];?>
														</td>
														<td>
															<?php echo $value['ssid'];?>
														</td>
														<td>
															<?php echo $value['sms_list_id'];?>
														</td>
														<td>
															<?php echo $value['is_show']==0?'未调用':'已调用';?>
														</td>
														<td>
															<?php echo $value['mobile'];?>
														</td>
														<td>
															<?php echo $value['mer_id'];?>
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

		<link href="<?=base_url().'css/bootstrap-datetimepicker.min.css'?>" rel="stylesheet" media="screen">
        <script src="<?=base_url().'bootstrap/js/bootstrap.min.js'?>"></script>
		<script src="<?=base_url().'js/bootstrap-datetimepicker.min.js'?>"></script>
</body>
</html>
