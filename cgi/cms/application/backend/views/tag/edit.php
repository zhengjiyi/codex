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
        <a class="btn" href="<?php echo base_url('tag')?>"><span>返回列表</span></a>
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
            <li><a href="<?php echo base_url('tag/'.$k.'/'.$tag->id)?>"><?php echo $v;?></a></li>
<?php endif;?>
<?php endforeach;?>
          </ul>
        </div>
      </div>
      <div id="subpanel">
        <form action="<?php echo base_url('tag/edit/'.$tag->id)?>" method="post" name="myform" id="myform">
          <div class="item"><label class="item-title" for="tag">标签名称：</label><input type="text" class="input-txt long" name="tag" id="tag" value="<?php echo $tag->tag;?>" /></div>
          <div class="item"><label class="item-title" for="tag_type_id">标签类型ID：</label>
            <select name="tag_type_id" id="tag_type_id">
              <option value="">标签类型ID</option>
<?php foreach($tag_type as $k => $v):?>
              <option<?php if($k == $tag->tag_type_id) echo ' selected="selected"';?> value="<?php echo $k;?>"><?php echo $v;?></option>
<?php endforeach;?>
            </select>
          </div>
          <div class="item"><label class="item-title" for="tag_en">标签 英文：</label><input type="text" class="input-txt long" name="tag_en" id="tag_en" value="<?php echo $tag->tag_en;?>" /></div>
          <div class="item"><label class="item-title" for="btn">&nbsp;</label>
            <input type="submit" name="ok" id="ok" value="保存" /><a id="cancel" class="input-btn" href="<?php echo base_url('tag')?>">取消</a>
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
            tag: {
                maxlength: 255
            },
            tag_en: {
                maxlength: 255
            }
        },
        messages: {
            tag: {
                maxlength: "长度不能超过255"
            },
            tag_en: {
                maxlength: "长度不能超过255"
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