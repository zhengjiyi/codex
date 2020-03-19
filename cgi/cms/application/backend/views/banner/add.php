<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CODEX - 后台管理</title>
<link href="<?php echo base_url('css/style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/center.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('js/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/ajaxfileupload.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.qd.uploads.js')?>" type="text/javascript"></script>
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
        <a class="btn" href="<?php echo base_url('banner')?>"><span>返回列表</span></a>
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
        <form action="<?php echo base_url('banner/add')?>" method="post" name="myform" id="myform">
          <div class="item"><label class="item-title" for="img">图片：</label>
            <div class="item-area">
              <div class="img-show"></div>
              <div class="img-pick">
                <input type="file" name="upload_img" id="upload_img" unselectable="on" />
                <input type="hidden" name="img" id="img" value="" />
              </div>
              <div class="img-info">限162M.</div>
            </div>
          </div>
          <div class="item"><label class="item-title" for="ord">排序（按大到小）：</label><input type="text" class="input-txt long" name="ord" id="ord" /></div>
          <div class="item"><label class="item-title" for="title_cn1">中文大标题：</label><input type="text" class="input-txt long" name="title_cn1" id="title_cn1" /></div>
          <div class="item"><label class="item-title" for="title_en1">英文大标题：</label><input type="text" class="input-txt long" name="title_en1" id="title_en1" /></div>
          <div class="item"><label class="item-title" for="title_cn2">中文小标题：</label><input type="text" class="input-txt long" name="title_cn2" id="title_cn2" /></div>
          <div class="item"><label class="item-title" for="title_en2">英文小标题：</label><input type="text" class="input-txt long" name="title_en2" id="title_en2" /></div>
          <div class="item"><label class="item-title" for="url_cn">跳转链接：</label><input type="text" class="input-txt long" name="url_cn" id="url_cn" /></div>
          <div class="item"><label class="item-title" for="url_en">英文跳转链接：</label><input type="text" class="input-txt long" name="url_en" id="url_en" /></div>
          <div class="item"><label class="item-title" for="type">1-图片 2-视频：</label>
<?php foreach($type as $k => $v):?>
            <span class="item-span"><?php echo $v;?>： <input type="radio" <?php if($k==1){ ?> checked<?php } ?> name="type" id="type" value="<?php echo $k;?>" /></span>
<?php endforeach;?>
          </div>
          <div class="item"><label class="item-title" for="video">视频：</label><div class="item-attach">
            <input type="file" name="upload_video" id="upload_video" class="attach" readonly="readonly" />
            <input type="text" class="input-txt long" name="video" id="video" />
            <input type="button" class="attach-btn" value="上传" />
          </div></div>
          <div class="item"><label class="item-title" for="btn">&nbsp;</label>
            <input type="submit" name="ok" id="ok" value="保存" /><a id="cancel" class="input-btn" href="<?php echo base_url('banner')?>">取消</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript">
var base_url = '<?php echo base_url()?>';
$().ready(function() {

    $("#upload_img").uploads({ctrl:'banner',field:'img',preview:true});
    $("#upload_video").uploads({ctrl:'banner',field:'video'});

    $.validator.setDefaults({
        submitHandler: function(myform) {
            myform.submit(); 
        }
    });
    $("#myform").validate({
        rules: {
            ord: {
                maxlength: 4
            },
            title_cn1: {
                maxlength: 255
            },
            title_en1: {
                maxlength: 255
            },
            title_cn2: {
                maxlength: 255
            },
            title_en2: {
                maxlength: 255
            },
            url_cn: {
                maxlength: 255
            },
            url_en: {
                maxlength: 255
            }
        },
        messages: {
            ord: {
                maxlength: "排序（按大到小）不能超过4个字符。"
            },
            title_cn1: {
                maxlength: "中文大标题不能超过255个字符。"
            },
            title_en1: {
                maxlength: "英文大标题不能超过255个字符。"
            },
            title_cn2: {
                maxlength: "中文小标题不能超过255个字符。"
            },
            title_en2: {
                maxlength: "英文小标题不能超过255个字符。"
            },
            url_cn: {
                maxlength: "跳转链接不能超过255个字符。"
            },
            url_en: {
                maxlength: "url_en不能超过255个字符。"
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