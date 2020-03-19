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
        <a class="btn" href="<?php echo base_url('video')?>"><span>返回列表</span></a>
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
            <li><a href="<?php echo base_url('video/'.$k.'/'.$video->id)?>"><?php echo $v;?></a></li>
<?php endif;?>
<?php endforeach;?>
          </ul>
        </div>
      </div>
      <div id="subpanel">
        <form action="<?php echo base_url('video/edit/'.$video->id)?>" method="post" name="myform" id="myform">
          <div class="item"><label class="item-title" for="code">视频地址（代码）：</label><div class="item-area"><textarea name="code" id="code" cols="45" rows="3"><?php echo $video->code;?></textarea></div></div>
          <div class="item"><label class="item-title" for="title">标题：</label><input type="text" class="input-txt long" name="title" id="title" value="<?php echo $video->title;?>" /></div>
          <div class="item"><label class="item-title" for="img">预览图（646x364）：</label>
            <div class="item-area">
              <div class="img-show">
<?php if(! empty($video->img)):?>
                <div class="img-view">
                  <span><img for="img" src="<?php echo base_url("../../$video->img"); ?>"></span>
                  <div id="move-img" class="img-move"></div>
                </div>
<?php endif;?>
              </div>
              <div class="img-pick">
                <input type="file" name="upload_img" id="upload_img" unselectable="on" />
                <input type="hidden" value="<?php echo $video->img;?>" name="img" id="img">
              </div>
              <div class="img-info">限5M.</div>
            </div>
          </div>
          <div class="item"><label class="item-title" for="ord">排序（按大到小）：</label><input type="text" class="input-txt long" name="ord" id="ord" value="<?php echo $video->ord;?>" /></div>
          <div class="item"><label class="item-title" for="btn">&nbsp;</label>
            <input type="submit" name="ok" id="ok" value="保存" /><a id="cancel" class="input-btn" href="<?php echo base_url('video')?>">取消</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript">
var base_url = '<?php echo base_url()?>';
$().ready(function() {

    $("#upload_img").uploads({ctrl:'video',field:'img',preview:true});

    $.validator.setDefaults({
        submitHandler: function(myform) {
            myform.submit(); 
        }
    });
    $("#myform").validate({
        rules: {
            title: {
                maxlength: 255
            },
            ord: {
                maxlength: 6
            }
        },
        messages: {
            title: {
                maxlength: "长度不能超过255"
            },
            ord: {
                maxlength: "长度不能超过6"
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