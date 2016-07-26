<?php 
	$this->load->view('header.php');
?>
<script type="text/javascript">
	$(function () {
		$('#start_create_time').datetimepicker({
			format: 'yyyy-mm-dd hh:ii:ss',
			startView:1
		});
		$('#end_create_time').datetimepicker({
			format: 'yyyy-mm-dd hh:ii:ss',
			startView:1
		});
		$('#start_send_time').datetimepicker({
			format: 'yyyy-mm-dd hh:ii:ss',
			startView:1
		});
		$('#end_send_time').datetimepicker({
			format: 'yyyy-mm-dd hh:ii:ss',
			startView:1
		});
	});

	function search(){
		var mobile = $('#mobile').val();
		var mer_id = $('#mer_id').val();
		var ssid = $('#ssid').val();
		var send_status = $('#send_status').val();
		var send_result = $('#send_result').val();
		var receive_result = $('#receive_result').val();
		var send_msg = $('#send_msg').val();
		var business_type = $('#business_type').val();
		var sms_class = $('#sms_class').val();
		var start_create_time = $('#start_create_time').val();
		var end_create_time = $('#end_create_time').val();
		var start_send_time = $('#start_send_time').val();
		var end_send_time = $('#end_send_time').val();
//		var report_data = $('#report_data').val();
		var report_msg = $('#report_msg').val();
		var is_addqueue = $('#is_addqueue').val();
		window.location.href="/admin/index.php/smslist/index?mobile="+mobile+"&mer_id="+mer_id+"&ssid="+ssid+"&send_status="+send_status+"&send_result="+send_result+"&receive_result="+receive_result+"&send_msg="+send_msg+"&business_type="+business_type+"&sms_class="+sms_class+"&start_create_time="+start_create_time+"&end_create_time="+end_create_time+"&start_send_time="+start_send_time+"&end_send_time="+end_send_time+"&report_msg="+report_msg+"&is_addqueue="+is_addqueue;
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
				           	 	<a href="#">短信详情列表</a> <span class="divider">/</span>
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
						<label for="is_addqueue">是否入队</label>
						  <select class="form-control" name="is_addqueue" id="is_addqueue" style="width:80px">
							  <option value="-1" <?php if(!empty($_GET['is_addqueue']) || isset($_GET['is_addqueue'])){echo $_GET['is_addqueue']==-1?'selected = "selected"':'';}?>>所有</option>
							  <option value="0"  <?php if(!empty($_GET['is_addqueue']) || isset($_GET['is_addqueue'])){echo $_GET['is_addqueue']==0?'selected = "selected"':'';}?>>未入队</option>
							  <option value="1"  <?php if(!empty($_GET['is_addqueue']) || isset($_GET['is_addqueue'])){echo $_GET['is_addqueue']==1?'selected = "selected"':'';}?>>入队</option>
						  </select>
						</span>
						<span style="float:left;margin-left:10px">
						<label for="send_status">是否发送</label>
						  <select class="form-control" name="send_status" id="send_status" style="width:80px">
							  <option value="-1" <?php if(!empty($_GET['send_status']) || isset($_GET['send_status'])){echo $_GET['send_status']==-1?'selected = "selected"':'';}?>>所有</option>
							  <option value="0"  <?php if(!empty($_GET['send_status']) || isset($_GET['send_status'])){echo $_GET['send_status']==0?'selected = "selected"':'';}?>>未发送</option>
							  <option value="1"  <?php if(!empty($_GET['send_status']) || isset($_GET['send_status'])){echo $_GET['send_status']==1?'selected = "selected"':'';}?>>已发送</option>
						  </select>
						</span>
						<span style="float:left;margin-left:10px">
						<label for="send_result">发送结果</label>
						  <select class="form-control" name="send_result" id="send_result" style="width:100px">
							  <option value="-1" <?php if(!empty($_GET['send_result']) || isset($_GET['send_result'])){echo $_GET['send_result']==-1?'selected = "selected"':'';}?>>所有</option>
							  <option value="0"  <?php if(!empty($_GET['send_result']) || isset($_GET['send_result'])){echo $_GET['send_result']==0?'selected = "selected"':'';}?>>发送失败</option>
							  <option value="1"  <?php if(!empty($_GET['send_result']) || isset($_GET['send_result'])){echo $_GET['send_result']==1?'selected = "selected"':'';}?>>发送成功</option>
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
						<label>发送结果描述</label>
							<input type="text" class="form-control" name="send_msg" id="send_msg" maxlength="18" style="width:140px" value="<?=empty($_GET['send_msg'])?'':$_GET['send_msg']?>">
						</span>
						<span style="float:left;margin-left:10px">
							<label>业务类型</label>
							<input type="text" class="form-control" name="business_type" id="business_type" style="width:100px" value="<?=empty($_GET['business_type'])?'':$_GET['business_type']?>">
						</span>
						<span style="float:left;margin-left:10px">
							<label>短信接口</label>
							<input type="text" class="form-control" name="sms_class" id="sms_class" style="width:100px" value="<?=empty($_GET['sms_class'])?'':$_GET['sms_class']?>">
						</span>
<!--						<span style="float:left;margin-left:10px">-->
<!--							<label>报文数据</label>-->
<!--							<input type="text" class="form-control" name="report_data" id="report_data" style="width:100px" value="--><?//=empty($_GET['report_data'])?'':$_GET['report_data']?><!--">-->
<!--						</span>-->
						<span style="float:left;margin-left:10px">
							<label>报文信息</label>
							<input type="text" class="form-control" name="report_msg" id="report_msg" style="width:100px" value="<?=empty($_GET['report_msg'])?'':$_GET['report_msg']?>">
						</span>
						<span style="float:left;margin-left:10px">
							<label>短信生成时间</label>
							开始时间<input type="text" class="form-control" name="start_create_time" id="start_create_time" value="<?=empty($_GET['start_create_time'])?'':$_GET['start_create_time']?>">
							结束时间<input type="text" class="form-control" name="end_create_time" id="end_create_time" value="<?=empty($_GET['end_create_time'])?'':$_GET['end_create_time']?>">
						</span>
						<span style="float:left;margin-left:10px">
							<label>短信发出时间</label>
							开始时间<input type="text" class="form-control" name="start_send_time" id="start_send_time" value="<?=empty($_GET['start_send_time'])?'':$_GET['start_send_time']?>">
							结束时间<input type="text" class="form-control" name="end_send_time" id="end_send_time" value="<?=empty($_GET['end_send_time'])?'':$_GET['end_send_time']?>">
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
												手机号
											</th>
											<th>
												短信内容
											</th>
											<th>
												商户号
											</th>
											<th>
												流水号
											</th>
											<th>
											   短信生成时间
											</th>
											<th>
											   是否发送
											</th>
											<th>
											   发送结果
											</th>
											<th>
											   发送结果描述
											</th>
										   <th>
											   短信接口返回结果
										   </th>
											<th>
											   短信发出时间
											</th>
											<th>
											   短信接收结果
											</th>
											<th>
											   短信接收时间
											</th>
											<th>
											   报文数据
											</th>
											<th>
											   报文信息
											</th>
											<th>
											   短信接口
											</th>
											<th>
											   业务类型
											</th>
											<th>
											   操作备注
											</th>
											<th>
											   是否入队
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
                                     						<?php echo $value['mobile'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['content'];?>
                                     					</td>
                                     					<td>
                                     						<?php echo $value['mer_id'];?>
                                     					</td>
														<td>
															<?php echo $value['ssid'];?>
														</td>
														<td>
															<?php echo $value['create_time'];?>
														</td>
														<td>
															<?php echo $value['send_status']==0?'未发送':'已发送';?>
														</td>
														<td>
															<?php echo $value['send_result']==0?'发送失败':'发送成功';?>
														</td>
														<td>
															<?php echo $value['send_msg'];?>
														</td>
														<td>
															<?php echo $value['send_data'];?>
														</td>
														<td>
															<?php echo $value['send_time'];?>
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
															<?php echo $value['sms_class'];?>
														</td>
														<td>
															<?php echo $value['business_type'];?>
														</td>
														<td>
															<?php echo $value['description'];?>
														</td>
														<td>
															<?php echo $value['is_addqueue']==0?'未入队':'入队';?>
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
