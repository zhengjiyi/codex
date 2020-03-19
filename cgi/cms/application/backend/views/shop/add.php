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
        <a class="btn" href="<?php echo base_url('shop')?>"><span>返回列表</span></a>
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
        <form action="<?php echo base_url('shop/add')?>" method="post" name="myform" id="myform">
          <div class="item"><label class="item-title" for="shop_cn">店面中文名称：</label><input type="text" class="input-txt long" name="shop_cn" id="shop_cn" /></div>
          <div class="item"><label class="item-title" for="shop_en">店面英文名称：</label><input type="text" class="input-txt long" name="shop_en" id="shop_en" /></div>
          <div class="item"><label class="item-title" for="address_cn">店面中文地址：</label><input type="text" class="input-txt long" name="address_cn" id="address_cn" /></div>
          <div class="item"><label class="item-title" for="address_en">店面英文地址：</label><input type="text" class="input-txt long" name="address_en" id="address_en" /></div>
          <div class="item"><label class="item-title" for="province">省份：</label><input type="text" class="input-txt long" name="province" id="province" /></div>
          <div class="item"><label class="item-title" for="city">城市：</label><input type="text" class="input-txt long" name="city" id="city" /></div>
          <div class="item"><label class="item-title" for="tel">店面电话：</label><input type="text" class="input-txt long" name="tel" id="tel" /></div>
          <div class="item"><label class="item-title" for="img">店面图片：</label>
            <div class="item-area">
              <div class="img-show"></div>
              <div class="img-pick">
                <input type="file" name="upload_img" id="upload_img" unselectable="on" />
                <input type="hidden" name="img" id="img" value="" />
              </div>
              <div class="img-info">限5M.</div>
            </div>
          </div>
          <div class="item"><label class="item-title" for="province_en">省份英文：</label><input type="text" class="input-txt long" name="province_en" id="province_en" /></div>
          <div class="item"><label class="item-title" for="city_en">城市英文：</label><input type="text" class="input-txt long" name="city_en" id="city_en" /></div>
          <div class="item"><label class="item-title" for="country">国家：</label><input type="text" class="input-txt long" name="country" id="country" /></div>
          <div class="item"><label class="item-title" for="country_en">国家英文：</label><input type="text" class="input-txt long" name="country_en" id="country_en" /></div>
          <div class="item"><label class="item-title" for="offer_time_en">营业时间（英文）：</label><input type="text" class="input-txt long" name="offer_time_en" id="offer_time_en" /></div>
          <div class="item"><label class="item-title" for="offer_time">营业时间：</label><input type="text" class="input-txt long" name="offer_time" id="offer_time" /></div>
          <div class="item"><label class="item-title" for="btn">&nbsp;</label>
            <input type="submit" name="ok" id="ok" value="保存" /><a id="cancel" class="input-btn" href="<?php echo base_url('shop')?>">取消</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript">
var base_url = '<?php echo base_url()?>';
$().ready(function() {

    $("#upload_img").uploads({ctrl:'shop',field:'img',preview:true});

    $.validator.setDefaults({
        submitHandler: function(myform) {
            myform.submit(); 
        }
    });
    $("#myform").validate({
        rules: {
            shop_cn: {
              required: true,
                maxlength: 255
            },
            shop_en: {
              required: true,
                maxlength: 255
            },
            address_cn: {
              required: true,
                maxlength: 255
            },
            address_en: {
              required: true,
                maxlength: 255
            },
            province: {
              required: true,
                maxlength: 255
            },
            city: {
              required: true,
                maxlength: 255
            },
            tel: {
              required: true,
                maxlength: 255
            },
            province_en: {
              required: true,
                maxlength: 255
            },
            city_en: {
              required: true,
                maxlength: 255
            },
            country: {
              required: true,
                maxlength: 255
            },
            country_en: {
              required: true,
                maxlength: 255
            },
            offer_time_en: {
              required: true,
                maxlength: 255
            },
            offer_time: {
                required: true,
                maxlength: 255
            }
        },
        messages: {
            shop_cn: {
                maxlength: "店面中文名称不能超过255个字符。"
            },
            shop_en: {
                maxlength: "店面英文名称不能超过255个字符。"
            },
            address_cn: {
                maxlength: "店面中文地址不能超过255个字符。"
            },
            address_en: {
                maxlength: "店面英文地址不能超过255个字符。"
            },
            province: {
                maxlength: "省份不能超过255个字符。"
            },
            city: {
                maxlength: "城市不能超过255个字符。"
            },
            tel: {
                maxlength: "店面电话不能超过255个字符。"
            },
            province_en: {
                maxlength: "省份英文不能超过255个字符。"
            },
            city_en: {
                maxlength: "城市英文不能超过255个字符。"
            },
            country: {
                maxlength: "国家不能超过255个字符。"
            },
            country_en: {
                maxlength: "国家英文不能超过255个字符。"
            },
            offer_time_en: {
                required: '营业时间不能为空',
                maxlength: "营业时间（英文）不能超过255个字符。"
            },
            offer_time: {
                required: '营业时间不能为空',
                maxlength: "营业时间不能超过255个字符。"
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