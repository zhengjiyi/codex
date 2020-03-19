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
        <a class="btn" href="<?php echo base_url('banner')?>"><span>返回列表</span></a>
      </div>
    </div>
    <div id="panel">
<?php if (isset($notice)): ?>
      <div id="notice">
        <h5 class="<?php echo $notice['result'];?>"><?php echo $notice['title'];?></h5>
        <p><a class="input-btn" href="<?php echo base_url('banner/add')?>">继续添加</a><a class="input-btn" href="<?php echo base_url('banner')?>">返回列表</a></p>
      </div>
<?php endif; ?>
      <div class="clear"></div>
      <div id="subpanel">
        <h3 class="cut-off"><span>基本信息</span><?php if (qd_func_auth('edit', $auth['banner'], 'edit')): ?><a href="<?php echo base_url('banner/edit/'.$banner->id)?>">编辑</a><?php endif;?></h3>
        <table class="col-list" width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <th width="100px;" scope="row">图片：</th>
            <td><?php if ($banner->img):?><a href="<?php echo base_url("../../$banner->img"); ?>" target="_blank"><img width="24" height="24" src="<?php echo base_url("../../$banner->img"); ?>"></a><?php endif;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">排序（按大到小）：</th>
            <td><?php echo $banner->ord;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">中文大标题：</th>
            <td><?php echo $banner->title_cn1;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">英文大标题：</th>
            <td><?php echo $banner->title_en1;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">中文小标题：</th>
            <td><?php echo $banner->title_cn2;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">英文小标题：</th>
            <td><?php echo $banner->title_en2;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">跳转链接：</th>
            <td><?php echo $banner->url_cn;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">添加时间戳：</th>
            <td><?php echo date('Y-m-d H:i:s', $banner->addtime);?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">英文跳转链接：</th>
            <td><?php echo $banner->url_en;?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">1-图片 2-视频：</th>
            <td><?php echo isset($type[$banner->type]) ? $type[$banner->type] : '未分配';?></td>
          </tr>
          <tr>
            <th width="100px;" scope="row">视频：</th>
            <td><?php if ($banner->video):?><a href="/<?php echo $banner->video;?>" target="_blank">下载</a><?php endif;?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>