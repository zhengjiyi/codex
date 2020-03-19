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
        <a class="btn" href="<?php echo base_url('product')?>"><span>返回列表</span></a>
      </div>
    </div>
    <div id="panel">
<?php if (isset($notice)): ?>
      <div id="notice">
        <h5 class="<?php echo $notice['result'];?>"><?php echo $notice['title'];?></h5>
        <p><a class="input-btn" href="<?php echo base_url('product/add')?>">继续添加</a><a class="input-btn" href="<?php echo base_url('product')?>">返回列表</a></p>
      </div>
<?php endif; ?>
      <div class="clear"></div>
      <div id="subpanel">
        <h3 class="cut-off"><span>基本信息</span><?php if (qd_func_auth('edit', $auth['product'], 'edit')): ?><a href="<?php echo base_url('product/edit/'.$product->id)?>">编辑</a><?php endif;?></h3>
        <table class="col-list" width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <th width="100px;" scope="row">型号：</th>
            <td><?php echo $product->model;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">系列：</th>
            <td><?php echo $product_type[$product->product_type];?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">排序：</th>
            <td><?php echo $product->ord;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">产品图片：</th>
            <td>
                <?php if ($product->img):?>
                <ul>
                <?php foreach($product->img as $img) { ?>
                        <li class="img-thumb"><a href="<?php echo base_url("../../$img");?>" target="_blank"><img src="<?php echo base_url("../../$img");?>"></a></li>
                <?php } ?>
                </ul>
                <?php endif;?>
            </td>
          </tr>
          <tr>
            <th width="100px;" scope="row">广告图片：</th>
            <td>
              <?php if ($product->ad_img):?>
                <ul>
                  <?php foreach($product->ad_img as $img) { ?>
                    <li class="img-thumb"><a href="/<?php echo $img;?>" target="_blank"><img src="/<?php echo $img;?>"></a></li>
                  <?php } ?>
                </ul>
              <?php endif;?>
            </td>
          </tr>
          <tr>
            <th width="100px;" scope="row">购买链接：</th>
            <td><?php echo $product->buy_link;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">价格：</th>
            <td><?php echo $product->price;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">价格（法郎）：</th>
            <td><?php echo $product->price_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">机芯-中文：</th>
            <td><?php echo $product->jx_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">机芯-英文：</th>
            <td><?php echo $product->jx_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">功能-中文：</th>
            <td><?php echo $product->gn_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">功能-英文：</th>
            <td><?php echo $product->gn_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表壳-中文：</th>
            <td><?php echo $product->bk_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表壳-英文：</th>
            <td><?php echo $product->bk_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表镜-中文：</th>
            <td><?php echo $product->bj_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表镜-英文：</th>
            <td><?php echo $product->bj_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">底盖-中文：</th>
            <td><?php echo $product->dg_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">底盖-英文：</th>
            <td><?php echo $product->dg_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表盘-中文：</th>
            <td><?php echo $product->bp_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表盘-英文：</th>
            <td><?php echo $product->bp_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表带-中文：</th>
            <td><?php echo $product->bd_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表带-英文：</th>
            <td><?php echo $product->bd_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表壳直径-中文：</th>
            <td><?php echo $product->bkzj_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">表壳直径-英文：</th>
            <td><?php echo $product->bkzj_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">防水-中文：</th>
            <td><?php echo $product->fs_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">防水-英文：</th>
            <td><?php echo $product->fs_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">标签：</th>
            <td><?php echo $product->tag;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">添加时间戳：</th>
            <td><?php echo date('Y-m-d H:i:s', $product->addtime);?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>