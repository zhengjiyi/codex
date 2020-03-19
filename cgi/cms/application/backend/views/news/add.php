<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CODEX - 后台管理</title>
<link href="<?php echo base_url('css/style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/center.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('js/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.validate.min.js')?>" type="text/javascript"></script>
<link href="<?php echo base_url('css/jquery/jquery.ui.core.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/jquery/jquery.ui.theme.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/jquery/jquery.ui.datepicker.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('js/kindeditor/themes/default/default.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('js/jquery.ui.core.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.ui.datepicker.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.ui.datepicker-zh-CN.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/ajaxfileupload.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.qd.uploads.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/overall.js')?>" type="text/javascript"></script>
  <style>
    #main {
      height: auto;
    }
  </style>
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
        <a class="btn" href="<?php echo base_url('news')?>"><span>返回列表</span></a>
      </div>
    </div>
    <div id="panel">
      <div id="headbar">
        <div id="topitems">
          <ul>
<?php foreach($items as $k => $v):?>
<?php if($k == 'edit'):?>
            <li class="on"><?php echo $v;?></li>
<?php else:?>
            <li class="step">&gt;</li><li><?php echo $v;?></li>
<?php endif;?>
<?php endforeach;?>
          </ul>
        </div>
      </div>
      <div id="subpanel">
        <form action="<?php echo base_url('news/add')?>" method="post" name="myform" id="myform">
          <div class="item"><label class="item-title" for="img">新闻图片：</label>
            <div class="item-area">
              <div class="img-show"></div>
              <div class="img-pick">
                <input type="file" name="upload_img" id="upload_img" unselectable="on" />
                <input type="hidden" name="img" id="img" value="" />
              </div>
              <div class="img-info">限5M.</div>
            </div>
          </div>
          <div class="item"><label class="item-title" for="pub_date">发布日期：</label><input type="text" class="input-txt long" style="z-index:1000;position:relative;" name="pub_date" id="pub_date" /></div>
          <div class="item"><label class="item-title" for="title_cn">中文标题：</label><input type="text" class="input-txt long" name="title_cn" id="title_cn" /></div>
          <div class="item"><label class="item-title" for="content_cn">中文正文：</label><div class="item-area"><textarea name="content_cn" id="content_cn" cols="45" rows="3"></textarea></div></div>
          <div class="item"><label class="item-title" for="title_en">英文标题：</label><input type="text" class="input-txt long" name="title_en" id="title_en" /></div>
          <div class="item"><label class="item-title" for="content_en">英文正文：</label><div class="item-area"><textarea name="content_en" id="content_en" cols="45" rows="3"></textarea></div></div>
          <div class="item"><label class="item-title" for="btn">&nbsp;</label>
            <input type="submit" name="ok" id="ok" value="保存" /><a id="cancel" class="input-btn" href="<?php echo base_url('news')?>">取消</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('js/kindeditor/kindeditor-min.js'); ?>"></script>
<script src="<?php echo base_url('js/kindeditor/lang/zh_CN.js'); ?>"></script>
<script language="javascript" type="text/javascript">
var base_url = '<?php echo base_url()?>';
$().ready(function() {

    var editor,editor1;
    KindEditor.ready(function(K) {
      editor = K.create('textarea[name="content_cn"]', {
        uploadJson : '<?php echo base_url('news/upload_img'); ?>',
        minHeight : 400,
        afterBlur: function () { editor.sync(); },
          urlType:'domain'
      });
    });
    KindEditor.ready(function(K) {
      editor1 = K.create('textarea[name="content_en"]', {
        uploadJson : '<?php echo base_url('news/upload_img'); ?>',
        minHeight : 400,
        afterBlur: function () { editor1.sync(); },
          urlType:'domain'
      });
    });
    $("#upload_img").uploads({ctrl:'news',field:'img',preview:true});

    $( "#pub_date" ).datepicker({
        changeMonth: true,
        changeYear: true
    }, "showAnim", "slideDown");

    $.validator.setDefaults({
        submitHandler: function(myform) {
            myform.submit(); 
        }
    });
    $("#myform").validate({
        rules: {
            pub_date: {
            },
            title_cn: {
                maxlength: 255
            },
            title_en: {
                maxlength: 255
            }
        },
        messages: {
            pub_date: {
            },
            title_cn: {
                maxlength: "中文标题不能超过255个字符。"
            },
            title_en: {
                maxlength: "英文标题不能超过255个字符。"
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