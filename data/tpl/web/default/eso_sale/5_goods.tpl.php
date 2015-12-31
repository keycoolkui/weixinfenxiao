<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript" src="resource/js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="resource/js/lib/jquery-ui-1.10.3.min.js"></script>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('goods', array('op' => 'post'))?>">添加商品</a></li>
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('goods', array('op' => 'display'))?>">管理商品</a></li>
</ul>
<?php  if($operation == 'post') { ?>

<link type="text/css" rel="stylesheet" href="../addons/eso_sale/images/uploadify_t.css" />
<style type='text/css'>
    .tab-pane { padding:20px 0 20px 0;}

</style>

<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit="return formcheck();">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <h4><?php  if(empty($item['id'])) { ?>添加商品<?php  } else { ?>编辑商品<?php  } ?></h4>
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#tab_basic">基本信息</a></li>
            <li><a href="#tab_des">商品描述</a></li>
            <!-- <li><a href="#tab_param">自定义属性</a></li>
           <li><a href="#tab_option">商品规格</a></li>

           <li><a href="#tab_other">其他设置</a></li>-->
        </ul>

        <div class="tab-content">
            <div class="tab-pane  active" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods_basic', TEMPLATE_INCLUDEPATH)) : (include template('goods_basic', TEMPLATE_INCLUDEPATH));?></div>
            <div class="tab-pane" id="tab_des"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods_des', TEMPLATE_INCLUDEPATH)) : (include template('goods_des', TEMPLATE_INCLUDEPATH));?></div>
            <div class="tab-pane" id="tab_param"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods_param', TEMPLATE_INCLUDEPATH)) : (include template('goods_param', TEMPLATE_INCLUDEPATH));?></div>
            <div class="tab-pane" id="tab_option"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods_option', TEMPLATE_INCLUDEPATH)) : (include template('goods_option', TEMPLATE_INCLUDEPATH));?></div>
            <!--<div class="tab-pane" id="tab_other"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods_other', TEMPLATE_INCLUDEPATH)) : (include template('goods_other', TEMPLATE_INCLUDEPATH));?></div>-->
        </div>
        <table class="tb">
            <tr>
                <th></th>
                <td>
                    <input name="submit" type="submit" value="提交" class="btn btn-primary span3">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="specWin" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
    <table class="table table-hover">
        <thead class="navbar-inner">
        <tr>
            <th style="width:100px;" class="row-hover">名称<i></i></th>
            <th style="text-align:right;">操作</th>
        </tr>
        </thead>
        <tbody id="spec-items">
        <?php  if(is_array($specs)) { foreach($specs as $field) { ?>
        <?php  $json = json_encode($field);?>
        <tr>
            <td><input  name="spec[]" type="text" value="<?php  echo $field['title'];?>"></td>
            <td style="text-align:right;">
                <?php  if(is_array($field['content'])) { foreach($field['content'] as $item) { ?>
                <span class="label label-info"><?php  echo $item;?></span>
                <?php  } } ?>
            </td>
            <td><a href="javascript:;" onclick='addSpec(<?php  echo $json;?>)'>添加</a></td>
        </tr>
        <?php  } } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    <!--
    var category = <?php  echo json_encode($children)?>;
    require(['jquery', 'util'], function($, u){
        $(function(){
            u.editor($('.richtext-clone')[0]);
        });
    });


    var category = <?php  echo json_encode($children)?>;

    $(function () {
        window.optionchanged = false;
        $('#myTab a').click(function (e) {
            e.preventDefault();//阻止a链接的跳转行为
            $(this).tab('show');//显示当前选中的链接及关联的content
        })
    });



    function formcheck(){
        if($("#pcate").val()=='0'){
            Tip.focus("pcate","请选择商品分类!","right");
            return false;
        }
        if($("#goodsname").isEmpty()) {
            $('#myTab a[href="#tab_basic"]').tab('show');
            Tip.focus("goodsname","请输入商品名称!","right");
            return false;
        }
        <?php  if(empty($id)) { ?>
            if ($.trim($(':file[name="thumb"]').val()) == '') {
                $('#myTab a[href="#tab_basic"]').tab('show');
                $('#myTab a[href="#tab_basic"]').tab('show');
                Tip.focus('thumb_div', '请上传缩略图.', 'right');
                return false;
            }
        <?php  } ?>

                if($("#goodsname").isEmpty()) {
                    $('#myTab a[href="#tab_basic"]').tab('show');
                    Tip.focus("goodsname","请输入商品名称!","right");
                    return false;
                }
                var full =  checkoption();
                if(!full){return false;}
                if(optionchanged){
                    $('#myTab a[href="#tab_option"]').tab('show');
                    message('规格数据有变动，请重新点击 [刷新规格项目表] 按钮!','','error');
                    return false;
                }
                return true;
            }

            function checkoption(){
                var full = true;
                if( $("#hasoption").get(0).checked){
                    $(".spec_title").each(function(i){
                        if( $(this).isEmpty()) {
                            $('#myTab a[href="#tab_option"]').tab('show');
                            Tip.focus(".spec_title:eq(" + i + ")","请输入规格名称!","top");
                            full =false;
                            return false;
                        }

                    });
                    $(".spec_item_title").each(function(i){
                        if( $(this).isEmpty()) {
                            $('#myTab a[href="#tab_option"]').tab('show');
                            Tip.focus(".spec_item_title:eq(" + i + ")","请输入规格项名称!","top");
                            full =false;
                            return false;
                        }
                    });
                }
                if(!full) { return false; }
                return full;
            }
    //-->
</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="eso_sale" />
                <input type="hidden" name="do" value="goods" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <select name="status" class='form-control'>
                            <option value="1" <?php  if(!empty($_GPC['status'])) { ?> selected<?php  } ?>>上架</option>
                            <option value="0" <?php  if(empty($_GPC['status'])) { ?> selected<?php  } ?>>下架</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">分类</label>
                    <div class="col-xs-6 col-sm-4">
                        <select class="form-control" style="margin-right:15px;" name="cate_1" onchange="fetchChildCategory(this.options[this.selectedIndex].value)">
                            <option value="0">请选择一级分类</option>
                            <?php  if(is_array($category)) { foreach($category as $row) { ?>
                            <?php  if($row['parentid'] == 0) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['cate_1']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
                            <?php  } ?>
                            <?php  } } ?>
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <select class="form-control input-medium" id="cate_2" name="cate_2">
                            <option value="0">请选择二级分类</option>
                            <?php  if(!empty($_GPC['cate_1']) && !empty($children[$_GPC['cate_1']])) { ?>
                            <?php  if(is_array($children[$_GPC['cate_1']])) { foreach($children[$_GPC['cate_1']] as $row) { ?>
                            <option value="<?php  echo $row['0'];?>" <?php  if($row['0'] == $_GPC['cate_2']) { ?> selected="selected"<?php  } ?>><?php  echo $row['1'];?></option>
                            <?php  } } ?>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class=" col-xs-12 col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="padding:15px;">
        <table class="table table-hover">
            <thead class="navbar-inner">
            <tr>
                <th style="width:60px;">ID</th>
                <th>商品标题</th>
                <th>商品属性(点击可修改)</th>
                <th>商品编号</th>
                <th>商品条码</th>
                <th>状态(点击可修改)</th>
                <th style="width:120px;">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <tr>
                <td><?php  echo $item['id'];?></td>
                <td><?php  if(!empty($category[$item['pcate']])) { ?><span class="text-error">[<?php  echo $category[$item['pcate']]['name'];?>] </span><?php  } ?><?php  if(!empty($children[$item['pcate']])) { ?><span class="text-info">[<?php  echo $children[$item['pcate']][$item['ccate']]['1'];?>] </span><?php  } ?><?php  echo $item['title'];?>
                </td>
                <td>
                    <label data='<?php  echo $item['isnew'];?>' class='label label-default <?php  if($item['isnew']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'new')">新品</label>
                    <label data='<?php  echo $item['ishot'];?>' class='label label-default <?php  if($item['ishot']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'hot')">热卖</label>
                    <label data='<?php  echo $item['isrecommand'];?>' class='label label-default <?php  if($item['isrecommand']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'recommand')">首页</label>
                    <label data='<?php  echo $item['isdiscount'];?>' class='label label-default <?php  if($item['isdiscount']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'discount')">折扣</label></td>
                <td><?php  echo $item['goodssn'];?></td>
                <td><?php  echo $item['productsn'];?></td>
                <td><?php  if($item['status']) { ?><span data='<?php  echo $item['status'];?>' onclick="setProperty1(this,<?php  echo $item['id'];?>,'status')" class="label label-default label-success" style="cursor:pointer;">销售中</span><?php  } else { ?><span data='<?php  echo $item['status'];?>' onclick="setProperty1(this,<?php  echo $item['id'];?>,'status')" class="label label-default" style="cursor:pointer;">已下架</span><?php  } ?></td>
                <td>
                    <a href="<?php  echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'post'))?>">编辑</a>&nbsp;&nbsp;
                    <a href="<?php  echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删除</a>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
            <tr>
                <td colspan="7">
                    <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                    <input type="submit" class="btn btn-primary" name="submit" value="提交" />
                </td>
            </tr>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<script type="text/javascript">
    <!--
    var category = <?php  echo json_encode($children)?>;
    function setProperty(obj,id,type){

        $(obj).html($(obj).html() + "...");
        $.post("<?php  echo $this->createWebUrl('setgoodsproperty')?>"
                ,{id:id,type:type, data: obj.getAttribute("data")}
                ,function(d){
                    $(obj).html($(obj).html().replace("...",""));
                    $(obj).attr("data",d.data)
                    if(d.result==1){
                        $(obj).toggleClass("label-info");
                    }
                },"json");
    }

    function setProperty1(obj,id,type){

        //$(obj).html($(obj).html() + "...");
        $.post("<?php  echo $this->createWebUrl('setgoodsproperty')?>"
                ,{id:id,type:type, data: obj.getAttribute("data")}
                ,function(d){
                    //$(obj).html($(obj).html().replace("...",""));
                    $(obj).attr("data",d.data);
                    if(d.data==1){
                        obj.innerHTML = '销售中';
                    }
                    if(d.data==0){
                        obj.innerHTML = '已下架';
                    }
                    $(obj).toggleClass("label-success");
                },"json");
    }
    //-->
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
