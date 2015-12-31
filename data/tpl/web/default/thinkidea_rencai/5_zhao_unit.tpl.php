<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">入驻企业管理</a></li>
</ul>
    <div style="padding:15px;">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th>ID/企业名称</th>
                    <th>申请时间</th>
                    <th>审核</th>
                    <th>认证</th>
                    <th>名企推荐</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($lists)) { foreach($lists as $row) { ?>
                <tr>
                    <td><small>(<?php  echo $row['id'];?>)<?php  echo $row['name'];?></small></small></td>
                    <td><small><?php  echo date('Y-m-d',$row['dateline'])?></small></td>
                    <td><small>
                        <?php  if($row['status'] == 0) { ?>
                        <a class="btn btn-warning btn-sm" href="javascript:void(0);" onclick="audit_change_company_status(<?php  echo $row['id'];?>, 1)">通过</a>
                        <a class="btn btn-warning btn-sm" href="javascript:void(0);" onclick="audit_change_company_status(<?php  echo $row['id'];?>, -1)">拒绝</a>
                        <?php  } else if($row['status'] == 1) { ?>
                        <a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="audit_change_company_status(<?php  echo $row['id'];?>, -1)">通过</a>
                        <?php  } else if($row['status'] == -1) { ?>
                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="audit_change_company_status(<?php  echo $row['id'];?>, 1)">失败</a>
                        <?php  } ?>
                    </small></td>
                    
                    <td><small>
                        <?php  if($row['isauth'] == 0) { ?>
                        	<a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="audit_change_company_auth(<?php  echo $row['id'];?>, 1)">电话</a>
                        	<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="audit_change_company_auth(<?php  echo $row['id'];?>, 2)">执照</a>
                        	<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="audit_change_company_auth(<?php  echo $row['id'];?>, -1)">拒绝</a>
                        <?php  } else if($row['isauth'] == 1) { ?>
                        	<a class="btn btn-primary btn-sm" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="点击后重新设置认证状态" onclick="audit_change_company_auth(<?php  echo $row['id'];?>, 0)">电话认证</a>
                       	<?php  } else if($row['isauth'] == 2) { ?>
                        	<a class="btn btn-success btn-sm" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="点击后重新设置认证状态" onclick="audit_change_company_auth(<?php  echo $row['id'];?>, 0)">执照认证</a>
                        <?php  } else if($row['isauth'] == -1) { ?>
                        	<a class="btn btn-danger btn-sm" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="点击后重新设置认证状态" onclick="audit_change_company_auth(<?php  echo $row['id'];?>, 0)">失败</a>
                        <?php  } ?>
                    </small></td>
                    <!--<td><small>-->
                    	<!--<span class="badge"><?php  echo $row['view_resume_total'];?></span>-->
                    	<!--<a class="btn btn-default btn-sm" href='<?php  echo $this->createWebUrl("AuditViewResumeTotal", array("company_id" => $row['id']));?>'>设置</a>-->
                    <!--</small></td>-->
                    <td>
                        <?php  if($row['position'] == 0) { ?>
                            <a class="btn btn-default btn-sm" href="javascript:void(0);">否</a>
                        <?php  } else { ?>
                            <a class="btn btn-success btn-sm" href="javascript:void(0);">是</a>
                        <?php  } ?>
                    </td>
                    <td>
                        <a href='<?php  echo $this->createWebUrl("ZhaounitEdit", array("id" => $row['id']));?>' title="编辑" class="btn btn-primary btn-sm">查看</a>
                        <a href="javascript:void(0);" onclick="delete_company(<?php  echo $row['id'];?>)" title="删除" class="btn btn-danger btn-sm">删除</a>
                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
    
	<script>
		//审核
	    function audit_change_company_status(company_id, change_to){
	    	$.post(
	    			'<?php  echo $this->createWebUrl("AuditCompanyStatusAjax")?>',
	    	        {"company_id":company_id, "change_to":change_to},
	    	        function (data){
	    	        	location.reload();
	    	        }
	    	);
	    }
	    //认证
	    function audit_change_company_auth(company_id, change_to){
	    	$.post(
	    			'<?php  echo $this->createWebUrl("AuditCompanyAuthAjax")?>',
	    	        {"company_id":company_id, "change_to":change_to},
	    	        function (data){
	    	        	location.reload();
	    	        }
	    	);
	    }
	    //删除企业
	    function delete_company(company_id){
	    	if(confirm('确定删除')){
		    	$.post(
		    			'<?php  echo $this->createWebUrl("DeleteCompanyAjax")?>',
		    	        {"company_id":company_id},
		    	        function (data){
		    	        	location.reload();
		    	        }
		    	);
	    	}	
	    }
	</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>