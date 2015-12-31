<?php defined('IN_IA') or exit('Access Denied');?> 
 <table>
                <tbody>
             
                    <tr>
                       
                        <td colspan="2">
 
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>属性名称</th>
                                        <th>属性值</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody   id="param-items">
                                    <?php  if(is_array($params)) { foreach($params as $p) { ?>
                                    <tr>
                                        <td><input name="param_title[]" type="text" class="span3 param_title" value="<?php  echo $p['title'];?>"/>
                                       <input name="param_id[]" type="hidden" class="span3" value="<?php  echo $p['id'];?>"/></td>
                                        <td><input name="param_value[]" type="text" class="span3 param_value" value="<?php  echo $p['value'];?>"/></td>
                                        <td><a href="javascript:;" class="icon-move" title="拖动调整此显示顺序" ></a>&nbsp;
                                            <a href="javascript:;" onclick="deleteParam(this)" style="margin-top:10px;"  title="删除"><i class='icon-remove'></i></a></td>
                                    </tr> 
                                    <?php  } } ?>             
                                </tbody>
                                <tbody>
                                    <tr>

                                        <td   colspan="3">  
                                            
                                            <a href="javascript:;" id='add-param' onclick="addParam()" style="margin-top:10px;"  title="添加属性">添加属性 <i class='icon-plus'></i></a>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
 
                            
                </tbody></table>
</td>
        </tr>
   
</table>


<script language="javascript">
    
    $(function(){
        
        $("#param-items").sortable({handle:'.icon-move'});
        $("#chkoption").click(function(){
            var obj =$(this);
            if(obj.get(0).checked){
                $("#tboption").show();   
                $(".trp").hide();
            }
            else{
                $("#tboption").hide();
                $(".trp").show();
            }
             
        });
        
    })
       function addParam() {
        var url = "<?php  echo $this->createWebUrl('param',array('name'=>'eso_sale'))?>";
        $.ajax({
           "url": url ,
           success:function(data){
               $('#param-items').append(data);
           }
        });
        return;
       
    }
    function deleteParam(o) {
        $(o).parent().parent().remove();
    }
    
    </script>