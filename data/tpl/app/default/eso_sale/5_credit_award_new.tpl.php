<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link type="text/css" rel="stylesheet" href="../addons/eso_sale/recouse/credit/base.css" />
<link type="text/css" rel="stylesheet" href="../addons/eso_sale/recouse/credit/style.css?v=1" />
         <script type="text/javascript" src="../addons/eso_sale/recouse/credit/script.js"></script>
<style>
body { background-repeat: repeat; }
#ziliao {width:100%; height:40px; clear:left;}
	#ziliao .gengai{width:49.8%; height:40px; float:left; font-size:18px; line-height:40px;
				     filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;}
	#ziliao a{text-decoration:none; color:#FFF;}
	#ziliao .gengai:active{background:rgba(200, 200, 200, 0.4) none repeat scroll 0 0 !important;}
	#ziliao .gengai1{width:49.8%; height:40px; float:left; font-size:18px; line-height:40px; background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;}
	#ziliao .gengai1 a{text-decoration:none; color:#12A7D1;}
	
</style>
		 
<title>奖品列表</title>
<section class="stay">
       
			<div id="ziliao">
		<div class="gengai" align="center"><a href="#">我的积分：<?php  echo $profile['credit1'];?></a></div>
	
		<div class="gengai" align="center"><a href="<?php  echo $this->mturl('list')?>">返回首页</a></div>

	</div>


    	<!--content-->
        <section class="stay_content">
			<?php  if(is_array($award_list)) { foreach($award_list as $item) { ?>
        	<!--box-->
            <section class="stay_box">
			<aside class="stay_title"><?php  echo $item['title'];?></aside>
                <article class="stay_main">
                    <p class="stay_banner"><img src="<?php  echo $_W['attachurl'].$item['logo']?>" /></p>
			        <!--item-->
                    <section class="stay_item">
                        <section class="stay_item_l fl">
                            <section class="stay_lump">
                                <span class="stay_lump_l">剩余数量：</span>
                                <p class="stay_lump_r"><span> <?php  echo $item['amount'];?></span></p>
                            </section>
                        </section>
                        <section class="stay_item_r fl">
                            <section class="stay_lump">
                                <span class="stay_lump_l">价值：</span>
                                <p class="stay_lump_r"><span><?php  echo $item['price'];?>元</span></p>
                            </section>
                        </section>
                        <section class="stay_item_r fl">
                            <section class="stay_lump">
                                <span class="stay_lump_l">消耗积分：</span>
                                <p class="stay_lump_r"><span><?php  echo $item['credit_cost'];?>分</span></p>
                            </section>
                        </section>
                    </section>
		    <section class="stay_item">		   
                        <section class="fl">
                            <section class="stay_lump">
                                <span class="stay_lump_l">截止日期：</span>
                                <p class="stay_lump_r"><span><?php  echo $item['deadline'];?></span></p>
                            </section>
                        </section>
 		    </section>
                    <!--item end-->
	                <!--item-->
                    <section class="stay_content">
						<?php  echo htmlspecialchars_decode($item['content'])?>
					</section>
                    <!--item end-->
					
                    <!--btn-->
                    <section class="stay_btn_layer">
                        <span class="stay_btn_x fl"><a href="<?php  echo $this->mturl('fillinfo', array('award_id' => $item['award_id']))?>"><span>兑换</span></a></span>
                    </section>
                    <!--btn end-->
                </article>
            </section>
            <!--box end-->
			<?php  } } ?>
        </section>
        <!--content end-->
    </section>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
