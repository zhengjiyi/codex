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
var base_url = '<?php echo base_url('product')?>';
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
<?php if (qd_func_auth('add', $auth['product'], 'edit')): ?>
      <div>
        <a class="btn" href="<?php echo base_url('product/add')?>"><span>添加产品</span></a>
      </div>
<?php endif;?>
    </div>
    <div id="panel">
      <div id="headbar">
        <div id="topsearch">
          <form id="seachform" name="seachform" method="get" action="<?php echo base_url('product/pages')?>">
            <input name="model" type="text" class="input-txt short" id="model" title="型号" onfocus="javascript:if(this.value == '型号') this.value = '';" value="<?php echo empty($where['model'])?'型号':$where['model']?>" />
            <select name="product_type" id="product_type">
              <option value="">系列</option>
<?php foreach($product_type as $k => $v):?>
              <option<?php if(isset($where['product_type']) && $where['product_type'] == $k) echo ' selected="selected"'?> value="<?php echo $k;?>"><?php echo $v;?></option>
<?php endforeach;?>
            </select>
            <button id="search" class="input-btn" type="submit">搜索</button>
          </form>
        </div>
        <div id="toppage"><?php echo $paging->tinylinks();?></div>
      </div>
      <div id="subpanel">
        <form id="listform" name="listform" method="post" action="<?php echo base_url('product/batch/del')?>">
        <table class="row-list" width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th scope="col">全选<input type="checkbox" name="checkAll" id="checkAll" /></th>
              <th scope="col">型号</th>
              <th scope="col">系列</th>
              <th scope="col">价格</th>
              <th scope="col"><?php echo qd_order_by('product/pages', $paging->query, 'ord', '排序（按大到小）')?></th>
              <th scope="col">操作</th>
            </tr>
          </thead>
<?php if (empty($list)): ?>
            <tbody>
              <tr>
                <td colspan="6">暂未添加产品：<a href="<?php echo base_url('product/add')?>">添加</a></td>
              </tr>
            </tbody>
<?php else: ?>
          <tbody>
<?php foreach($list as $k=>$row):?>
            <tr id="<?php echo $row->id;?>">
              <td><input type="checkbox" name="product[<?php echo $row->id;?>]" id="product_<?php echo $row->id;?>" value="<?php echo $row->id;?>" class="checkIt" /></td>
              <td><?php echo $row->model;?></td>
              <td><?php echo isset($product_type[$row->product_type]) ? $product_type[$row->product_type] : '未分配';?></td>
              <td><?php echo $row->price;?></td>
              <td><?php echo $row->ord;?></td>
              <td><a href="<?php echo base_url('product/view/'.$row->id)?>">查看</a>
<?php if (qd_func_auth('edit', $auth['product'], 'edit')): ?>
                | <a href="<?php echo base_url('product/edit/'.$row->id)?>">编辑</a>
<?php endif;?>
<?php if (qd_func_auth('del', $auth['product'], 'del')): ?>
                | <a id="<?php echo $row->id;?>" title="产品:<?php echo $row->model;?>" class="delIt" href="javascript:void(0)">删除</a>
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