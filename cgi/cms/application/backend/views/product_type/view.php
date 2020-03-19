<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CODEX - 后台管理</title>
<link href="<?php echo base_url('css/style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/center.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('js/jquery.min.js')?>" type="text/javascript"></script>
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
        <a class="btn" href="<?php echo base_url('product_type')?>"><span>返回列表</span></a>
      </div>
    </div>
    <div id="panel">
<?php if (isset($notice)): ?>
      <div id="notice">
        <h5 class="<?php echo $notice['result'];?>"><?php echo $notice['title'];?></h5>
        <p><a class="input-btn" href="<?php echo base_url('product_type/add')?>">继续添加</a><a class="input-btn" href="<?php echo base_url('product_type')?>">返回列表</a></p>
      </div>
<?php endif; ?>
      <div class="clear"></div>
      <div id="subpanel">
        <h3 class="cut-off"><span>基本信息</span><?php if (qd_func_auth('edit', $auth['product_type'], 'edit')): ?><a href="<?php echo base_url('product_type/edit/'.$product_type->id)?>">编辑</a><?php endif;?></h3>
        <table class="col-list" width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <th width="100px;" scope="row">系列：</th>
            <td><?php echo $product_type->type_name;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">系列代表图片：</th>
            <td><?php if ($product_type->image):?><a href="/<?php echo $product_type->image;?>" target="_blank"><img width="24" height="24" src="/<?php echo $product_type->image;?>"></a><?php endif;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">系列 英文：</th>
            <td><?php echo $product_type->type_name_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">排序（按大到小）：</th>
            <td><?php echo $product_type->ord;?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>