<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CODEX - 后台管理</title>
<link href="<?php echo base_url('css/style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/center.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('js/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/overall.js')?>" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
var base_url = '<?php echo base_url('shop')?>';
</script>
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
<?php if (qd_func_auth('add', $auth['shop'], 'edit')): ?>
      <div>
        <a class="btn" href="<?php echo base_url('shop/add')?>"><span>添加门店管理</span></a>
      </div>
<?php endif;?>
    </div>
    <div id="panel">
      <div class="clear"></div>
      <div id="subpanel">
        <form id="listform" name="listform" method="post" action="<?php echo base_url('shop/batch/del')?>">
        <table class="row-list" width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th scope="col">全选<input type="checkbox" name="checkAll" id="checkAll" /></th>
              <th scope="col">店面中文名称</th>
              <th scope="col">店面中文地址</th>
              <th scope="col">省份</th>
              <th scope="col">城市</th>
              <th scope="col">店面电话</th>
              <th scope="col">店面图片</th>
              <th scope="col">国家</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
<?php if (empty($list)): ?>
            <tbody>
              <tr>
                <td colspan="9">暂未添加门店管理：<a href="<?php echo base_url('shop/add')?>">添加</a></td>
              </tr>
            </tbody>
<?php else: ?>
          <tbody>
<?php foreach($list as $k=>$row):?>
            <tr id="<?php echo $row->id;?>">
              <td><input type="checkbox" name="shop[<?php echo $row->id;?>]" id="shop_<?php echo $row->id;?>" value="<?php echo $row->id;?>" class="checkIt" /></td>
              <td><?php echo $row->shop_cn;?></td>
              <td><?php echo $row->address_cn;?></td>
              <td><?php echo $row->province;?></td>
              <td><?php echo $row->city;?></td>
              <td><?php echo $row->tel;?></td>
              <td><?php if ($row->img):?><a href="<?php echo base_url("../../$row->img"); ?>" target="_blank"><img width="24" height="24" src="<?php echo base_url("../../$row->img"); ?>"></a><?php endif;?></td>
              <td><?php echo $row->country;?></td>
              <td><a href="<?php echo base_url('shop/view/'.$row->id)?>">查看</a>
<?php if (qd_func_auth('edit', $auth['shop'], 'edit')): ?>
                | <a href="<?php echo base_url('shop/edit/'.$row->id)?>">编辑</a>
<?php endif;?>
<?php if (qd_func_auth('del', $auth['shop'], 'del')): ?>
                | <a id="<?php echo $row->id;?>" title="门店管理:<?php echo $row->shop_cn;?>" class="delIt" href="javascript:void(0)">删除</a>
<?php endif;?>
              </td>
            </tr>
<?php endforeach;?>
          </tbody>
<?php endif;?>
        </table>
        <div id="footbar">
          <div id="action"><button id="delChecked" type="button">删除选中</button></div>
          <div id="paging"><?php echo $paging->links();?></div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>