<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>


<?php  if(defined('IN_MESSAGE')) { ?>
<div class="col-md-6" style="margin: 0 auto; float: none;padding-top:5%; width: 38%;">
	<div class="panel panel-primary">
		<div class="panel-heading ui-draggable-handle">
			<?php  if(is_array($msg)) { ?>
			<h3 class="panel-title">MYSQL 错误：</h3>
		</div>
		<div class="panel-body">
			<h3><?php  echo cutstr($msg['sql'], 300, 1);?></h3>
			<p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
		</div>
		<?php  } else { ?>
		<h3 class="panel-title"><?php  echo $caption;?></h3>

		<div class="panel-body">
			<h3><?php  echo $msg;?></h3>
			<?php  } ?>
			<?php  if($redirect) { ?>
			<h4><a href="<?php  echo $redirect;?>" class="alert-link">如果你的浏览器没有自动跳转，请点击此链接</a></h4>
			<script type="text/javascript">
				setTimeout(function () {
					location.href = "<?php  echo $redirect;?>";
				}, 3000);
			</script>
			<?php  } else { ?>
			<h4>[<a href="javascript:history.go(-1);" class="alert-link">点击这里返回上一页</a>] &nbsp; [<a href="./?refresh" class="alert-link">首页</a>]</h4>
			<?php  } ?></div></div>
	<div class="panel-footer">
		<div class="contact-info" style="float: right;
width: 36%;">
			<p><small>山东刘老太软件科技有限公司</small></p>

		</div>
	</div>
</div>


<?php  } else { ?>
<div class="page-container page-navigation-top-fixed">
 	<div class="page-sidebar page-sidebar-fixed">
			<!-- START X-NAVIGATION -->

			<ul class="x-navigation" id="navexp" >

<li class="xn-logo">
                <a href="javascript:;"></a>
               
            </li>
				<li class="xn-profile">
					<div class="profile">

						<div class="profile-image">
							<img src="<?php  echo $_W['attachurl'];?>headimg_<?php  echo $_W['uniacid'];?>.jpg?$acid=<?php  echo $_W['uniacid'];?>" class="" onerror="this.src='resource/wdlcms/assets/images/users/568.jpg'" />
						</div>
                        <script>
                            $(document).ready(function(){
                                $(".profile-data-title").load("<?php  echo url('home/welcome/ext');?> .profile-data-title") });  </script>
						<div class="profile-data">
							<div class="profile-data-name"><?php  echo $_W['user']['username'];?></div>
							<div class="profile-data-title"></div>
						</div>

					</div>
				</li>
				<?php $frames = empty($frames) ? $GLOBALS['frames'] : $frames; _calc_current_frames($frames);?>
				<?php  if(!empty($frames)) { ?>
				<?php  if(is_array($frames)) { foreach($frames as $k => $frame) { ?>
				<li class="xn-openable active">

					<a data-toggle="collapse"  data-parent="#frame-<?php  echo $k;?>" href="#frame-<?php  echo $k;?>"><span class="xn-text"><?php  echo $frame['title'];?></span></a>

					<ul id="frame-<?php  echo $k;?>" class="panel-collapse collapse in">
						<li>
							<?php  if(is_array($frame['items'])) { foreach($frame['items'] as $link) { ?>

							<a class="list-group-item1<?php  echo $link['active'];?>" href="<?php  echo $link['url'];?>" ><?php  echo $link['title'];?></a>

							<?php  } } ?></li>
					</ul>

				</li>
				<?php  } } ?><?php  } ?></ul>


		</div>
        <!-- START X-NAVIGATION -->
	
	<div class="page-content" style="margin-left: 223px;">
	<ul class="x-navigation x-navigation-horizontal" style="padding-right: 220px;">
		
		<li class="xn-openable pull-left">
			<a href="<?php  echo url('home/welcome/ext');?>" ><i class="fa fa-dedent"></i>功能管理首页</a>
		</li>
		<li class="xn-openable pull-left">
			<a href="./themes/default/wx/index.html" target="_blank"><i class="fa fa-file-text"></i>编辑微信图文</a>
		</li>
		<li class="xn-openable pull-right">
			<a href="<?php  echo url('user/logout');?>" class="mb-control" data-box="#mb-signout"><i class="fa fa-sign-out"></i> 退出</a>
		</li>
		<li class="pull-right xn-openable">
			<a href="javascript:;" >
				<i class="fa fa-user"></i> <?php  echo $_W['user']['username'];?></a>
		</li>
		<li class="xn-openable pull-right" >
			<a href="http://univalsoft.com"  target="_blank"><i class="fa fa-comments-o"></i> <span class="hf2weafr225">刘老太微信平台</span></a>
		</li>

	</ul>



			<div class="page-content-wrap" >


				<div id="row" style="margin-top: 20px;">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-body"><?php  } ?>