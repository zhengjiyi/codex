<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CODEX - 后台管理</title>
<link href="<?php echo base_url('css/style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/center.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('js/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/overall.js')?>" type="text/javascript"></script>
</head>

<body>
<!--header--->
<?php $this->load->view('header');?>
<!--header end-->
<div id="wrapper">
<!--menu--->
<?php $this->load->view('menu');?>
<!--menu end-->
  <div id="main">
    <div id="crumbs">当前位置：<?php echo $current;?>管理
      <div>
        <a class="btn" href="<?php echo base_url('tag_type')?>"><span>返回列表</span></a>
      </div>
    </div>
    <div id="panel">
      <div id="headbar">
        <div id="topitems">
          <ul>
<?php foreach($items as $k => $v):?>
<?php if($k == 'edit'):?>
            <li class="on">基本信息</li>
<?php else:?>
            <li><a href="<?php echo base_url('tag_type/'.$k.'/'.$tag_type->id)?>"><?php echo $v;?></a></li>
<?php endif;?>
<?php endforeach;?>
          </ul>
        </div>
      </div>
      <div id="subpanel">
        <form action="<?php echo base_url('tag_type/edit/'.$tag_type->id)?>" method="post" name="myform" id="myform">
          <div class="item"><label class="item-title" for="typename">标签类型名称：</label><input type="text" class="input-txt long" name="typename" id="typename" value="<?php echo $tag_type->typename;?>" /></div>
          <div class="item"><label class="item-title" for="typename_en">标签类别 英文：</label><input type="text" class="input-txt long" name="typename_en" id="typename_en" value="<?php echo $tag_type->typename_en;?>" /></div>
          <div class="item"><label class="item-title" for="ord">排序（按大到小）：</label><input type="text" class="input-txt long" name="ord" id="ord" value="<?php echo $tag_type->ord;?>" /></div>
          <div class="item"><label class="item-title" for="btn">&nbsp;</label>
            <input type="submit" name="ok" id="ok" value="保存" /><a id="cancel" class="input-btn" href="<?php echo base_url('tag_type')?>">取消</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript">
var base_url = '<?php echo base_url()?>';
$().ready(function() {
    $.validator.setDefaults({
        submitHandler: function(myform) {
            myform.submit(); 
        }
    });
    $("#myform").validate({
        rules: {
            typename: {
                maxlength: 255
            },
            typename_en: {
                maxlength: 255
            },
            ord: {
                maxlength: 4
            }
        },
        messages: {
            typename: {
                maxlength: "长度不能超过255"
            },
            typename_en: {
                maxlength: "长度不能超过255"
            },
            ord: {
                maxlength: "长度不能超过4"
            }
        },
        success: "checked",
        focusInvalid: true,
        onkeyup: false
    });
});
</script>
</body>
</html>