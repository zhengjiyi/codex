<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CODEX - 后台管理</title>
<link href="<?php echo base_url('css/style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/center.css')?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('js/select2/css/select2.min.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('js/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/ajaxfileupload.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.qd.uploads.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/overall.js')?>" type="text/javascript"></script>
  <script src="<?php echo base_url('js/select2/js/select2.full.min.js')?>"></script>
  <script src="<?php echo base_url('js/select2/js/i18n/zh-CN.js')?>"></script>
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
        <a class="btn" href="<?php echo base_url('product')?>"><span>返回列表</span></a>
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
            <li><a href="<?php echo base_url('product/'.$k.'/'.$product->id)?>"><?php echo $v;?></a></li>
<?php endif;?>
<?php endforeach;?>
          </ul>
        </div>
      </div>
      <div id="subpanel">
        <form action="<?php echo base_url('product/edit/'.$product->id)?>" method="post" name="myform" id="myform">
          <div class="item"><label class="item-title" for="model">型号：</label><input type="text" class="input-txt long" name="model" id="model" value="<?php echo $product->model;?>" /></div>
            <div class="item"><label class="item-title" for="ord">排序（按大到小）：</label><input type="text" class="input-txt long" name="ord" id="ord" value="<?php echo $product->ord;?>" /></div>
          <div class="item"><label class="item-title" for="product_type">系列：</label>
            <select name="product_type" id="product_type">
              <option value="">系列</option>
<?php foreach($product_type as $k => $v):?>
              <option<?php if($k == $product->product_type) echo ' selected="selected"';?> value="<?php echo $k;?>"><?php echo $v;?></option>
<?php endforeach;?>
            </select>
          </div>
          <div class="item"><label class="item-title" for="img">产品图片：</label>
            <div class="item-area">
              <div class="img-show">
<?php if(! empty($product->img)):?>
<?php foreach($product->img as $k => $v){ ?>
                <div class="img-view">
                  <span><img for="img" src="<?php echo base_url("../../$v"); ?>"></span>
                  <div id="move-img-<?php echo $k+1; ?>" class="img-move"></div>
                </div>
<?php } ?>
<?php endif;?>
              </div>
              <div class="img-pick">
                <input type="file" name="upload_img" id="upload_img" unselectable="on" />
				  <?php foreach($product->img as $k => $v){ ?>
                <input type="hidden" value="<?php echo $v;?>" name="img[]" id="img_<?php echo $k+1; ?>">
                  <?php } ?>
              </div>
              <div class="img-info">限19M.</div>
            </div>
          </div>
          <div class="item"><label class="item-title" for="ad_img">广告图片：</label>
            <div class="item-area">
              <div class="img-show">
<?php if(! empty($product->ad_img)):?>
  <?php foreach($product->ad_img as $k => $v){ ?>
    <div class="img-view">
      <span><img for="ad_img" src="<?php echo base_url("../../$v"); ?>"></span>
      <div id="move-ad_img-<?php echo $k+1; ?>" class="img-move"></div>
    </div>
  <?php } ?>
<?php endif;?>
              </div>
              <div class="img-pick">
                <input type="file" name="upload_ad_img" id="upload_ad_img" unselectable="on" />
                <?php if(! empty($product->ad_img)):?>
                <?php foreach($product->ad_img as $k => $v){ ?>
                  <input type="hidden" value="<?php echo $v;?>" name="ad_img[]" id="ad_img_<?php echo $k+1; ?>">
                <?php } ?>
                <?php endif;?>
              </div>
              <div class="img-info">限9M.</div>
            </div>
          </div>
          <div class="item item-inline"><label class="item-title" for="price">价格：</label><input type="text" class="input-txt long" name="price" id="price" value="<?php echo $product->price;?>" /></div>
            <div class="item item-inline"><label class="item-title" for="price_en">价格（法郎）：</label><input type="text" class="input-txt long" name="price_en" id="price_en" value="<?php echo $product->price_en;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="jx_cn">机芯类别：</label><input type="text" class="input-txt long" name="jx_cn" id="jx_cn" value="<?php echo $product->jx_cn;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="jx_en">Types of movement：</label><input type="text" class="input-txt long" name="jx_en" id="jx_en" value="<?php echo $product->jx_en;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="gn_cn">机芯功能：</label><input type="text" class="input-txt long" name="gn_cn" id="gn_cn" value="<?php echo $product->gn_cn;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="gn_en">Movement function：</label><input type="text" class="input-txt long" name="gn_en" id="gn_en" value="<?php echo $product->gn_en;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="bk_cn">表壳材质：</label><input type="text" class="input-txt long" name="bk_cn" id="bk_cn" value="<?php echo $product->bk_cn;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="bk_en">Case material：</label><input type="text" class="input-txt long" name="bk_en" id="bk_en" value="<?php echo $product->bk_en;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="bj_cn">表镜材质：</label><input type="text" class="input-txt long" name="bj_cn" id="bj_cn" value="<?php echo $product->bj_cn;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="bj_en">Glass material：</label><input type="text" class="input-txt long" name="bj_en" id="bj_en" value="<?php echo $product->bj_en;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="dg_cn">底部：</label><input type="text" class="input-txt long" name="dg_cn" id="dg_cn" value="<?php echo $product->dg_cn;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="dg_en">Bottom：</label><input type="text" class="input-txt long" name="dg_en" id="dg_en" value="<?php echo $product->dg_en;?>" /></div>
<!--          <div class="item item-inline"><label class="item-title" for="bp_cn">表盘-中文：</label><input type="text" class="input-txt long" name="bp_cn" id="bp_cn" value="--><?php //echo $product->bp_cn;?><!--" /></div>-->
<!--          <div class="item item-inline"><label class="item-title" for="bp_en">表盘-英文：</label><input type="text" class="input-txt long" name="bp_en" id="bp_en" value="--><?php //echo $product->bp_en;?><!--" /></div>-->
          <div class="item item-inline"><label class="item-title" for="bd_cn">表带材质：</label><input type="text" class="input-txt long" name="bd_cn" id="bd_cn" value="<?php echo $product->bd_cn;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="bd_en">Watchband material：</label><input type="text" class="input-txt long" name="bd_en" id="bd_en" value="<?php echo $product->bd_en;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="bkzj_cn">表壳直径：</label><input type="text" class="input-txt long" name="bkzj_cn" id="bkzj_cn" value="<?php echo $product->bkzj_cn;?>" /></div>
          <div class="item item-inline"><label class="item-title" for="bkzj_en">Case diameter：</label><input type="text" class="input-txt long" name="bkzj_en" id="bkzj_en" value="<?php echo $product->bkzj_en;?>" /></div>
            <div class="item item-inline"><label class="item-title" for="fs_cn">防水：</label><input type="text" class="input-txt long" name="fs_cn" id="fs_cn" value="<?php echo $product->fs_cn;?>" /></div>
            <div class="item item-inline"><label class="item-title" for="fs_en">WaterProof：</label><input type="text" class="input-txt long" name="fs_en" id="fs_en" value="<?php echo $product->fs_en;?>"  /></div>
          <div class="item"><label class="item-title" for="tag">标签：</label>
            <select name="tag[]" id="tag" multiple="multiple" class="select2">
              <?php foreach($tag as $k => $tag_data) { ?>
                <optgroup label="<?php echo $k; ?>">
                  <?php foreach($tag_data as $v) { ?>
                    <option value="<?php echo $v->id; ?>"<?php if(in_array($v->id, $product->tag)) echo ' selected="selected"';?>><?php echo $v->tag; ?></option>
                  <?php } ?>
                </optgroup>
              <?php } ?>
            </select>
          </div>
          <div class="item"><label class="item-title" for="btn">&nbsp;</label>
            <input type="submit" name="ok" id="ok" value="保存" /><a id="cancel" class="input-btn" href="<?php echo base_url('product')?>">取消</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript">
var base_url = '<?php echo base_url()?>';
$().ready(function() {
  $('.select2').select2({
    language: "zh-CN",
      closeOnSelect: false
  });
    $("#upload_img").uploads({ctrl:'product',field:'img',preview:true,multi:true,name:'img[]'});
  $("#upload_ad_img").uploads({ctrl:'product',field:'ad_img',preview:true,multi:true,name:'ad_img[]'});

    $.validator.setDefaults({
        submitHandler: function(myform) {
            myform.submit(); 
        }
    });
    $("#myform").validate({
        rules: {
            price: {
                required: true
            },
            price_en: {
                required: true
            },
            model: {
                maxlength: 255
            },
            buy_link: {
                maxlength: 255
            },
            jx_cn: {
                maxlength: 255
            },
            jx_en: {
                maxlength: 255
            },
            gn_cn: {
                maxlength: 255
            },
            gn_en: {
                maxlength: 255
            },
            bk_cn: {
                maxlength: 255
            },
            bk_en: {
                maxlength: 255
            },
            bj_cn: {
                maxlength: 255
            },
            bj_en: {
                maxlength: 255
            },
            dg_cn: {
                maxlength: 255
            },
            dg_en: {
                maxlength: 255
            },
            bp_cn: {
                maxlength: 255
            },
            bp_en: {
                maxlength: 255
            },
            bd_cn: {
                maxlength: 255
            },
            bd_en: {
                maxlength: 255
            },
            bkzj_cn: {
                maxlength: 255
            },
            bkzj_en: {
                maxlength: 255
            }
        },
        messages: {
            price: {
                required: '请填写价格',
                digits: '必须输入合法的数字'
            },
            price_en: {
                required: '请填写价格',
                digits: '必须输入合法的数字'
            },
            model: {
                maxlength: "长度不能超过255"
            },
            buy_link: {
                maxlength: "长度不能超过255"
            },
            jx_cn: {
                maxlength: "长度不能超过255"
            },
            jx_en: {
                maxlength: "长度不能超过255"
            },
            gn_cn: {
                maxlength: "长度不能超过255"
            },
            gn_en: {
                maxlength: "长度不能超过255"
            },
            bk_cn: {
                maxlength: "长度不能超过255"
            },
            bk_en: {
                maxlength: "长度不能超过255"
            },
            bj_cn: {
                maxlength: "长度不能超过255"
            },
            bj_en: {
                maxlength: "长度不能超过255"
            },
            dg_cn: {
                maxlength: "长度不能超过255"
            },
            dg_en: {
                maxlength: "长度不能超过255"
            },
            bp_cn: {
                maxlength: "长度不能超过255"
            },
            bp_en: {
                maxlength: "长度不能超过255"
            },
            bd_cn: {
                maxlength: "长度不能超过255"
            },
            bd_en: {
                maxlength: "长度不能超过255"
            },
            bkzj_cn: {
                maxlength: "长度不能超过255"
            },
            bkzj_en: {
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