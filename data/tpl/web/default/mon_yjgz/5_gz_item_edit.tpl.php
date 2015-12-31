<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>





<ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('GZItem',array('yid'=>$yid));?>">关注项管理</a></li>
	<li class="active"> <a href="<?php  echo $this->createWebUrl('GzItemEdit',array('yid'=>$yid));?>">添加关注</a></li>

</ul>

<div class="main">
	<form action="" method="post" class="form-horizontal form"
		  enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php  echo $gz_item['id'];?>" />
		<input type="hidden" name="yid" value="<?php  echo $yid;?>" />

		<div class="panel panel-default">
	<div class="panel-heading">
		关注项管理
	</div>
	<div class="panel-body">

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>名称：</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text"  class="form-control span7"
					   placeholder="" name="title" value="<?php  echo $gz_item['title'];?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>排序(序号从小到大)：</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text"  class="form-control span7"
					   placeholder="" name="sort" value="<?php  echo $gz_item['sort'];?>">
			</div>
		</div>
		

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>公众号图标logo：</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('icon',$gz_item['icon']);?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>关注链接地址：</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" id="title" class="form-control span7"
					   placeholder="" name="i_url" value="<?php  echo $gz_item['i_url'];?>">
			</div>
		</div>


		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>公众账号描述：</label>
			<div class="col-sm-9 col-xs-12">
				<textarea style="height: 400px; width: 100%;"
						  class="form-control  richtext-clone" name="i_desc" id="i_desc" cols="70"><?php  echo $gz_item['i_desc'];?></textarea>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<input name="submit" type="submit" value="提交"
					   class="btn btn-primary span3"> <input type="hidden"
															 name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>





	</div>

	</div>

</form>
	</div>


<script>


	require(['jquery', 'util'], function($, u){
		$(function(){
			//u.editor($('#i_desc')[0]);

		});

	});

</script>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>