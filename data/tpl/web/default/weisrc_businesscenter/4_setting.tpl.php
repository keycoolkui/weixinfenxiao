<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
     .item_box img{
         width: 100%;
         height: 100%;
     }
</style>
<style type='text/css'>
    .tab-pane { padding:20px 0 20px 0;}
</style>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php  echo $setting['id'];?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            商家信息
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#tab_basic">基本设置</a></li>
                <li><a href="#tab_settled">入驻设置</a></li>
                <li><a href="#tab_nave">导航设置</a></li>
                <li><a href="#tab_share">分享设置</a></li>
                <li><a href="#tab_auth">借用授权</a></li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane  active" id="tab_basic">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">网站名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="<?php  echo $setting['title'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页滚动公告</label>
                    <div class="col-sm-9">
                        <label for="scroll_announce_enable1" class="radio-inline"><input type="radio" name="scroll_announce_enable" value="1" id="scroll_announce_enable1" <?php  if(empty($setting) || $setting['scroll_announce_enable'] == 1) { ?>checked="true"<?php  } ?> /> 开启</label>
                        <label for="scroll_announce_enable2" class="radio-inline"><input type="radio" name="scroll_announce_enable" value="0" id="scroll_announce_enable2"  <?php  if(!empty($setting) && $setting['scroll_announce_enable'] == 0) { ?>checked="true"<?php  } ?> /> 关闭</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">公告滚动速度</label>
                    <div class="col-sm-9">
                        <input type="text" name="scroll_announce_speed" class="form-control" value="<?php  if(empty($setting)) { ?>6<?php  } else { ?><?php  echo $setting['scroll_announce_speed'];?><?php  } ?>" />
                        <span class="help-block">公告滚动速度,默认速度为6,数值越大滚动越快.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页滚动公告</label>
                    <div class="col-sm-9">
                        <textarea name="scroll_announce" class="form-control"><?php  if(empty($setting['scroll_announce'])) { ?><?php  echo $_W['account']['account'];?>微商圈平台正式开通，现全城商家招募中，有意加入的商家，请自主提交加盟信息，或者qq：15595755...<?php  } else { ?><?php  echo $setting['scroll_announce'];?><?php  } ?>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">公告链接</label>
                    <div class="col-sm-9">
                        <input type="text" name="scroll_announce_link" class="form-control" value="<?php  if(empty($setting)) { ?>#<?php  } else { ?><?php  echo $setting['scroll_announce_link'];?><?php  } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">列表每页显示数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="pagesize" class="form-control" value="<?php  if(empty($setting)) { ?>5<?php  } else { ?><?php  echo $setting['pagesize'];?><?php  } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示留言</label>
                    <div class="col-sm-9">
                        <label for="feedback_show_enable1" class="radio-inline"><input type="radio" name="feedback_show_enable" value="1" id="feedback_show_enable1" <?php  if(empty($setting) || $setting['feedback_show_enable'] == 1) { ?>checked="true"<?php  } ?> /> 开启</label>
                        <label for="feedback_show_enable2" class="radio-inline"><input type="radio" name="feedback_show_enable" value="0" id="feedback_show_enable2"  <?php  if(!empty($setting) && $setting['feedback_show_enable'] == 0) { ?>checked="true"<?php  } ?> /> 关闭</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">留言是否需要审核</label>
                    <div class="col-sm-9">
                        <label for="feedback_check_enable1" class="radio-inline"><input type="radio" name="feedback_check_enable" value="1" id="feedback_check_enable1" <?php  if(empty($setting) || $setting['feedback_check_enable'] == 1) { ?>checked="true"<?php  } ?> /> 开启</label>
                        <label for="feedback_check_enable2" class="radio-inline"><input type="radio" name="feedback_check_enable" value="0" id="feedback_check_enable2"  <?php  if(!empty($setting) && $setting['feedback_check_enable'] == 0) { ?>checked="true"<?php  } ?> /> 关闭</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">底部版权</label>
                    <div class="col-sm-9">
                        <input type="text" name="copyright" class="form-control" value="<?php  if(empty($setting) || empty($setting['copyright'])) { ?><?php  echo $_W['account']['account'];?>微商圈<?php  } else { ?><?php  echo $setting['copyright'];?><?php  } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">底部版权链接</label>
                    <div class="col-sm-9">
                        <input type="text" name="copyright_link" class="form-control" value="<?php  if(empty($setting) || empty($setting['copyright_link'])) { ?>#<?php  } else { ?><?php  echo $setting['copyright_link'];?><?php  } ?>" />
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_nave">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">导航名称一</label>
                    <div class="col-sm-9">
                        <input type="text" name="menuname1" class="form-control" value="<?php  if(empty($setting) || empty($setting['menuname1'])) { ?>优惠资讯<?php  } else { ?><?php  echo $setting['menuname1'];?><?php  } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">导航链接一</label>
                    <div class="col-sm-9">
                        <input type="text" name="menulink1" class="form-control" value="<?php  if(empty($setting) || empty($setting['menulink1'])) { ?><?php  echo $this->createMobileurl('news')?><?php  } else { ?><?php  echo $setting['menulink1'];?><?php  } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">导航名称二</label>
                    <div class="col-sm-9">
                        <input type="text" name="menuname2" class="form-control" value="<?php  if(empty($setting) || empty($setting['menuname2'])) { ?>积分兑换<?php  } else { ?><?php  echo $setting['menuname2'];?><?php  } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">导航链接二</label>
                    <div class="col-sm-9">
                        <input type="text" name="menulink2" class="form-control" value="<?php  if(empty($setting) || empty($setting['menulink2'])) { ?>#<?php  } else { ?><?php  echo $setting['menulink2'];?><?php  } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">导航名称三</label>
                    <div class="col-sm-9">
                        <input type="text" name="menuname3" class="form-control" value="<?php  if(empty($setting) || empty($setting['menuname3'])) { ?>领优惠券<?php  } else { ?><?php  echo $setting['menuname3'];?><?php  } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">导航链接三</label>
                    <div class="col-sm-9">
                        <input type="text" name="menulink3" class="form-control" value="<?php  if(empty($setting) || empty($setting['menulink3'])) { ?>#<?php  } else { ?><?php  echo $setting['menulink3'];?><?php  } ?>" />
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_share">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享时的标题</label>
                    <div class="col-sm-9">
                        <input type="text" id="share_title" name="share_title" value="<?php  echo $setting['share_title'];?>" class="form-control" /><div class="help-block">留空以网站名称作为标题</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">封面</label>
                    <div class="col-sm-9">
                        <?php  echo tpl_form_field_image('share_image', $share_image, '../addons/weisrc_businesscenter/template/themes/images/nopic.jpeg', array('width' => 640, 'height' => 640))?>
                        <span class="help-block" style="color:#f00">建议尺寸640*640</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享时的摘要</label>
                    <div class="col-sm-9">
                        <input type="text" id="share_desc" name="share_desc" value="<?php  echo $setting['share_desc'];?>" class="form-control" />
                        <div class="help-block">留空以网站名称作为内容</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">用户分享的链接</label>
                    <div class="col-sm-9">
                        <input type="text" id="share_url" name="share_url" value="<?php  echo $setting['share_url'];?>" class="form-control" />
                        <div class="help-block">建议留空，让用户把测试链接分享出去。</div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_auth">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppId:</label>
                    <div class="col-sm-9">
                        <input type="text" name="appid" class="form-control" value="<?php  if(!empty($setting)) { ?><?php  echo $setting['appid'];?><?php  } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret:</label>
                    <div class="col-sm-9">
                        <input type="text" name="secret" class="form-control" value="<?php  if(!empty($setting)) { ?><?php  echo $setting['secret'];?><?php  } ?>" />
                        <span class="help-block" style="width:550px;">
                        借用说明：必需设置借用高级认证号的OAuth2.0网页授权的回调域名为你公众号第三方平台的全域名。
					    如：你的域名为：<font color="red">wx.weixin.com</font> ，你必需让借用高级认证号设置OAuth2.0网页授权的回调域名为:<font color="red">wx.weixin.com</font>
                        </span>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_settled">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家入驻</label>
                    <div class="col-sm-9">
                        <label for="settled1" class="radio-inline"><input type="radio" name="settled" value="1" id="settled1" <?php  if(empty($setting) || $setting['settled'] == 1) { ?>checked="true"<?php  } ?> /> 开启</label>
                        <label for="settled2" class="radio-inline"><input type="radio" name="settled" value="0" id="settled2"  <?php  if(!empty($setting) && $setting['settled'] == 0) { ?>checked="true"<?php  } ?> /> 关闭</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">入驻公告</label>
                    <div class="col-sm-9">
                        <textarea name="announcement" class="richtext-clone form-control"><?php  echo $setting['announcement'];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">联系电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="tel" class="form-control" value="<?php  echo $setting['tel'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">地址</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" id="address" value="<?php  echo $setting['address'];?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家所在地区</label>
                    <div class="col-sm-3">
                        <select name="location_p" id="location_p" class="location form-control"></select>
                    </div>
                    <div class="col-sm-3">
                        <select name="location_c" id="location_c" class="location form-control"></select>
                    </div>
                    <div class="col-sm-3">
                        <select name="location_a" id="location_a" class="location form-control"></select>
                        <script type="text/javascript" src="../addons/weisrc_businesscenter/template/js/region_select.js"></script>
                        <script type="text/javascript">
                            var location_p = "<?php  if(!empty($setting['location_p'])) { ?><?php  echo $setting['location_p'];?><?php  } else { ?>广东省<?php  } ?>";
                            var location_c = "<?php  if(!empty($setting['location_c'])) { ?><?php  echo $setting['location_c'];?><?php  } else { ?>汕头市<?php  } ?>";
                            var location_a = "<?php  if(!empty($setting['location_a'])) { ?><?php  echo $setting['location_a'];?><?php  } else { ?>龙湖区<?php  } ?>";
                            new PCAS("location_p", "location_c", "location_a", location_p, location_c, location_a);
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">经纬度</label>
                    <div class="col-sm-9">
                        <div class="input-append">
                            <input type="text" id="place" class="input-xlarge form-control" name="place" value="<?php  echo $setting['place'];?>" data-rule-required="true" style="width:200px;display: inline;">
                            <button class="btn" type="button" id="positioning" onclick="bmap.searchMapByAddress($('#place').val())">搜索</button>
                        </div>
                        <span class="maroon" style="color: #f30;margin-left: 5px;">注意：这个只是模糊定位，准确位置请地图上标注!</span>
                        <div id="l-map" style="overflow: hidden; position: relative; z-index: 0; background-image: url(http://api.map.baidu.com/images/bg.png);width: 500px; height: 300px;margin-top: 10px; color: rgb(0, 0, 0); text-align: left;"></div>
                        <div id="r-result">
                            <input type="text" id="lat" name="lat"> <input type="text" id="lng" name="lng">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div>
	</form>
</div>
<script type="text/javascript">
        require(['util'],function(util){
         util.editor( $(".richtext-clone")[0]);
    });
    $(function () {
        window.optionchanged = false;  require(['bootstrap'],function(){
        $('#myTab a').click(function (e) {
            e.preventDefault();//阻止a链接的跳转行为
            $(this).tab('show');//显示当前选中的链接及关联的content
        }) });
    });

</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
<script type="text/javascript" src="http://api.map.baidu.com/getscript?v=1.4&ak=&services=&t=20140102035142"></script>
<script type="text/javascript">
    $(function(){
        $(".location").change(function(){
            bmap.searchMapByPCD();
        });
    });
    new PCAS("location_p", "location_c", "location_a", location_p, location_c, location_a);
    var bmap = {
        'option' : {
            'lock' : false,
            'container' : 'l-map',
            'infoWindow' : {'width' : 250, 'height' : 100, 'title' : ''},
            'point' : {'lng' : "<?php  if($setting['lng']!='0.0000000000' && !empty($setting['lng'])) { ?><?php  echo $setting['lng'];?><?php  } else { ?>116.735049<?php  } ?>", 'lat' : "<?php  if($setting['lat']!='0.0000000000' && !empty($setting['lat'])) { ?><?php  echo $setting['lat'];?><?php  } else { ?>23.367896<?php  } ?>"}
        },
        'init' : function(option) {
            var $this = this;
            $this.option = $.extend({},$this.option,option);

            $this.option.defaultPoint = new BMap.Point($this.option.point.lng, $this.option.point.lat);
            $this.bgeo = new BMap.Geocoder();
            $this.bmap = new BMap.Map($this.option.container);
            $this.bmap.centerAndZoom($this.option.defaultPoint, 15);
            $this.bmap.enableScrollWheelZoom();
            $this.bmap.enableDragging();
            $this.bmap.enableContinuousZoom();
            $this.bmap.addControl(new BMap.NavigationControl());
            $this.bmap.addControl(new BMap.OverviewMapControl());
            //添加标注
            $this.marker = new BMap.Marker($this.option.defaultPoint);
            $this.marker.setLabel(new BMap.Label('请您移动此标记，选择您的坐标！', {'offset':new BMap.Size(10,-20)}));
            $this.marker.enableDragging();
            $this.bmap.addOverlay($this.marker);
            //$this.marker.setAnimation(BMAP_ANIMATION_BOUNCE);
            $this.showPointValue($this.marker.getPosition());
            //拖动地图事件
            $this.bmap.addEventListener("dragging", function() {
                $this.setMarkerCenter();
                $this.option.lock = false;
            });
            //缩入地图事件
            $this.bmap.addEventListener("zoomend", function() {
                $this.setMarkerCenter();
                $this.option.lock = false;
            });
            //拖动标记事件
            $this.marker.addEventListener("dragend", function (e) {
                $this.showPointValue();
                $this.showAddress();
                $this.bmap.panTo(new BMap.Point(e.point.lng, e.point.lat));
                $this.option.lock = false;
                $this.marker.setAnimation(null);
            });
        },
        'searchMapByAddress' : function(address) {
            var $this = this;
            $this.bgeo.getPoint(address, function (point) {
                if (point) {
                    $this.showPointValue();
                    $this.showAddress();
                    $this.bmap.panTo(point);
                    $this.setMarkerCenter();
                }
            });
        },
        'searchMapByPCD' : function(address) {
            //alert($('#location_p').val()+$('#location_c').val()+$('#location_a').val());
            var $this = this;
            $this.option.lock = true;
            $this.searchMapByAddress($('#location_p').val()+$('#location_c').val()+$('#location_a').val());
        },
        'setMarkerCenter' : function() {
            var $this = this;
            var center = $this.bmap.getCenter();
            $this.marker.setPosition(new BMap.Point(center.lng, center.lat));
            $this.showPointValue();
            $this.showAddress();
        },
        'showPointValue' : function() {
            var $this = this;
            var point = $this.marker.getPosition();
            $('#lng').val(point.lng);
            $('#lat').val(point.lat);
        },
        'showAddress' : function() {
            var $this = this;
            var point = $this.marker.getPosition();
            $this.bgeo.getLocation(point, function (s) {
                if (s) {
                    $('#place').val(s.address);
                    if (!$this.option.lock) {
                        new PCAS("location_p", "location_c", "location_a", s.addressComponents.province, s.addressComponents.city, s.addressComponents.district);
                    }
                }
            });
        }
    };
    $(function(){
        var option = {};
        bmap.init(option);
    });</script>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>