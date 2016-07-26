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
				           	 	<a href="<?php echo site_url("sms/index")?>">短信接口列表</a> <span class="divider">/</span>
				            </li>
			            </ul>
	                </div>
		      	</div>
                <div class="span12" id="content">
                   <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">短信接口列表</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <form class="form-horizontal" action="<?php echo site_url("sms/index")?>" id="setting_form" method="get">
                                <fieldset>
                                	<legend><a href="<?php echo site_url("sms/add");?>"><button type="button" class="btn btn-primary ">新增接口</button></a></legend>
	                                <div class="control-group">
	                                     <label class="control-label" for="focusedInput">接口名称：</label>
	                                     <div class="controls">
	                                         <input class="focused" id="name" type="text" name="name" value="<?php echo $name;?>"/>
	                                     </div>
	                                </div>
	                                <div class="control-group">
	                                     <label class="control-label" for="focusedInput">是否启用：</label>
	                                     <div class="controls">
	                                        <select name="is_effect">
                                              <option value="" <?php if ($is_effect === '') {?> selected <?php }?> >全部</option>
                                              <option value="1" <?php if ($is_effect == '1') {?> selected <?php }?> >已启用</option>
                                              <option value="0" <?php if ($is_effect == '0') {?> selected <?php }?> >不启用</option>
                                            </select>
	                                     </div>
	                                </div>
	                                <div class="form-actions">
                                          <button class="btn btn-primary" type="submit">查询</button>
                                    </div>
                                </fieldset>
                                </form>
  									<table class="table">
						              <thead>
						                <tr>
						                  <th>序号</th>
						                  <th>接口名称</th>
						                  <th>接口类名</th>
						                  <th>接口是否启用</th>
						                  <th>优先级</th>
						                  <th>接口描述</th>
						                  <th>操作</th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php if (!empty($list)){
						                	foreach ($list as $key=>$item)
						                	{
						                ?>
						                <tr>
						                  <td><?php echo $item['id']; ?></td>
						                  <td><?php echo $item['name'];?></td>
						                  <td><?php echo $item['class_name'];?></td>
						                  <td><?php echo $item['is_effect_label'];?></td>
						                  <td><?php echo $item['sort'];?></td>
						                  <td><?php echo $item['description'];?></td>
						                  <td><?php if ($item['is_effect'] == '0') {?><a href="<?php echo site_url("sms/effect?id=".$item['id']);?>"><button class="btn btn-primary"><i class="icon-pencil icon-white" ></i> 启用</button></a><?php }else {?><a href="<?php echo site_url("sms/invalid?id=".$item['id']);?>"><button class="btn btn-danger"><i class="icon-remove icon-white"></i> 卸载</button></a><?php }?>
						                  <a href="<?php echo site_url("sms/edit?id=".$item['id']);?>"><button class="btn btn-inverse"><i class="icon-refresh icon-white"></i> 编辑</button></a>
						                  </td>
						                </tr>
						                <?php 		
						                	}
						                }?>
						                
						              </tbody>
						            </table>
                                </div>
                                 <div class="span6">						            
        						            <div class="dataTables_paginate paging_bootstrap pagination">
        						                <ul>
                                              	 <?php echo $page;?>
                                              	</ul>
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
</body>
</html>