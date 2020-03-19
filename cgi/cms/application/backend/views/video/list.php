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
var base_url = '<?php echo base_url('video')?>';
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
<?php if (qd_func_auth('add', $auth['video'], 'edit')): ?>
      <div>
        <a class="btn" href="<?php echo base_url('video/add')?>"><span>添加视频管理</span></a>
      </div>
<?php endif;?>
    </div>
    <div id="panel">
      <div class="clear"></div>
      <div id="subpanel">
        <form id="listform" name="listform" method="post" action="<?php echo base_url('video/batch/del')?>">
        <table class="row-list" width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th scope="col">全选<input type="checkbox" name="checkAll" id="checkAll" /></th>
              <th scope="col">标题</th>
              <th scope="col"><?php echo qd_order_by('video/pages', $paging->query, 'ord', '排序（按大到小）')?></th>
              <th scope="col">添加时间</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
<?php if (empty($list)): ?>
            <tbody>
              <tr>
                <td colspan="5">暂未添加视频管理：<a href="<?php echo base_url('video/add')?>">添加</a></td>
              </tr>
            </tbody>
<?php else: ?>
          <tbody>
<?php foreach($list as $k=>$row):?>
            <tr id="<?php echo $row->id;?>">
              <td><input type="checkbox" name="video[<?php echo $row->id;?>]" id="video_<?php echo $row->id;?>" value="<?php echo $row->id;?>" class="checkIt" /></td>
              <td><?php echo $row->title;?></td>
              <td><?php echo $row->ord;?></td>
              <td><?php echo date('Y-m-d', $row->addtime);?></td>
              <td><a href="<?php echo base_url('video/view/'.$row->id)?>">查看</a>
<?php if (qd_func_auth('edit', $auth['video'], 'edit')): ?>
                | <a href="<?php echo base_url('video/edit/'.$row->id)?>">编辑</a>
<?php endif;?>
<?php if (qd_func_auth('del', $auth['video'], 'del')): ?>
                | <a id="<?php echo $row->id;?>" title="视频管理" class="delIt" href="javascript:void(0)">删除</a>
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