<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_var['site']; ?> - 后台管理</title>
<link href="<?php echo '<?php'; ?>
 echo base_url('css/style.css')<?php echo '?>'; ?>
" rel="stylesheet" type="text/css" />
<link href="<?php echo '<?php'; ?>
 echo base_url('css/center.css')<?php echo '?>'; ?>
" rel="stylesheet" type="text/css" />
<script src="<?php echo '<?php'; ?>
 echo base_url('js/jquery.min.js')<?php echo '?>'; ?>
" type="text/javascript"></script>
<script src="<?php echo '<?php'; ?>
 echo base_url('js/overall.js')<?php echo '?>'; ?>
" type="text/javascript"></script>
</head>

<body>
<!--header--->
<?php echo '<?php'; ?>
 $this->load->view('header');<?php echo '?>'; ?>

<!--header end-->
<div id="wrapper">
<!--menu--->
<?php echo '<?php'; ?>
 $this->load->view('menu');<?php echo '?>'; ?>

<!--menu end-->
  <div id="main">
    <div id="crumbs">当前位置：<?php echo '<?php'; ?>
 echo $current;<?php echo '?>'; ?>
管理
      <div>
        <a class="btn" href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>')<?php echo '?>'; ?>
"><span>返回列表</span></a>
      </div>
    </div>
    <div id="panel">
<?php echo '<?php'; ?>
 if (isset($notice)): <?php echo '?>'; ?>

      <div id="notice">
        <h5 class="<?php echo '<?php'; ?>
 echo $notice['result'];<?php echo '?>'; ?>
"><?php echo '<?php'; ?>
 echo $notice['title'];<?php echo '?>'; ?>
</h5>
        <p><a class="input-btn" href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/add')<?php echo '?>'; ?>
">继续添加</a><a class="input-btn" href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>')<?php echo '?>'; ?>
">返回列表</a></p>
      </div>
<?php echo '<?php'; ?>
 endif; <?php echo '?>'; ?>

      <div class="clear"></div>
      <div id="subpanel">
        <h3 class="cut-off"><span>基本信息</span><?php echo '<?php'; ?>
 if (qd_func_auth('edit', $auth['<?php echo $this->_var['table']; ?>'], 'edit')): <?php echo '?>'; ?>
<a href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/edit/'.$<?php echo $this->_var['table']; ?>->id)<?php echo '?>'; ?>
">编辑</a><?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
</h3>
        <table class="col-list" width="100%" border="1" cellspacing="0" cellpadding="0">
<?php $_from = $this->_var['entry']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format_0_08634100_1548579362');if (count($_from)):
    foreach ($_from AS $this->_var['field'] => $this->_var['format_0_08634100_1548579362']):
?>
<?php if ($this->_var['format_0_08634100_1548579362'] == 'catalog'): ?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td><?php echo '<?php'; ?>
 echo array_key_exists($<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>, $<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>) ? $<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>[$<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>]['name'] : '';<?php echo '?>'; ?>
</td>
          </tr>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'select-from-db' || $this->_var['format_0_08634100_1548579362'] == 'radio-from-db' || $this->_var['format_0_08634100_1548579362'] == 'checkbox-from-db'): ?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td><?php echo '<?php'; ?>
 echo $<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>[$<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>];<?php echo '?>'; ?>
</td>
          </tr>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'select-from-array' || $this->_var['format_0_08634100_1548579362'] == 'radio-from-array' || $this->_var['format_0_08634100_1548579362'] == 'checkbox-from-array'): ?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td><?php echo '<?php'; ?>
 echo isset($<?php echo $this->_var['field']; ?>[$<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>]) ? $<?php echo $this->_var['field']; ?>[$<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>] : '未分配';<?php echo '?>'; ?>
</td>
          </tr>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'switch'): ?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td><?php echo '<?php'; ?>
 echo $<?php echo $this->_var['field']; ?>[$<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>];<?php echo '?>'; ?>
</td>
          </tr>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'enabled'): ?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td><?php echo '<?php'; ?>
 echo $<?php echo $this->_var['field']; ?>[$<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>];<?php echo '?>'; ?>
</td>
          </tr>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'image' || $this->_var['format_0_08634100_1548579362'] == 'gallery'): ?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td><?php echo '<?php'; ?>
 if ($<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>):<?php echo '?>'; ?>
<a href="/<?php echo '<?php'; ?>
 echo $<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>;<?php echo '?>'; ?>
" target="_blank"><img width="24" height="24" src="/<?php echo '<?php'; ?>
 echo $<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>;<?php echo '?>'; ?>
"></a><?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
</td>
          </tr>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'attach'): ?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td><?php echo '<?php'; ?>
 if ($<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>):<?php echo '?>'; ?>
<a href="/<?php echo '<?php'; ?>
 echo $<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>;<?php echo '?>'; ?>
" target="_blank">下载</a><?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
</td>
          </tr>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'addtime'): ?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td><?php echo '<?php'; ?>
 echo date('Y-m-d H:i:s', $<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>);<?php echo '?>'; ?>
</td>
          </tr>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'hidden'): ?>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'seo_title' || $this->_var['format_0_08634100_1548579362'] == 'seo_keywords' || $this->_var['format_0_08634100_1548579362'] == 'seo_description'): ?>
<?php elseif ($this->_var['format_0_08634100_1548579362'] == 'position'): ?>
          <tr>
            <th width="100px;" scope="row">区域：</th>
            <td><?php echo '<?php'; ?>
 echo qd_position(<?php $_from = $this->_var['position']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>$<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?><?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>, <?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>);<?php echo '?>'; ?>
</td>
          </tr>
<?php else: ?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td><?php echo '<?php'; ?>
 echo $<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>;<?php echo '?>'; ?>
</td>
          </tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </table>
<?php if ($this->_var['seo']): ?>
<?php echo '<?php'; ?>
 if (! empty($seo)):<?php echo '?>'; ?>

        <h3 class="cut-off"><span>SEO设置</span><?php echo '<?php'; ?>
 if (qd_func_auth('edit', $auth['<?php echo $this->_var['table']; ?>'], 'edit')): <?php echo '?>'; ?>
<a href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/seo/'.$<?php echo $this->_var['table']; ?>->id)<?php echo '?>'; ?>
">编辑</a><?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
</h3>
        <table class="col-list" width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <th width="100px;" scope="row">SEO标题：</th>
            <td><?php echo '<?php'; ?>
 echo $seo['title'];<?php echo '?>'; ?>
</td>
          </tr>
          <tr>
            <th width="100px;" scope="row">SEO关键词：</th>
            <td><?php echo '<?php'; ?>
 echo $seo['keywords'];<?php echo '?>'; ?>
</td>
          </tr>
          <tr>
            <th width="100px;" scope="row">SEO描述：</th>
            <td><?php echo '<?php'; ?>
 echo $seo['description'];<?php echo '?>'; ?>
</td>
          </tr>
        </table>
<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

<?php endif; ?>
<?php if ($this->_var['gallery']): ?>
<?php echo '<?php'; ?>
 if (! empty($gallery)):<?php echo '?>'; ?>

        <h3 class="cut-off"><span>SEO设置</span><?php echo '<?php'; ?>
 if (qd_func_auth('edit', $auth['<?php echo $this->_var['table']; ?>'], 'edit')): <?php echo '?>'; ?>
<a href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/seo/'.$<?php echo $this->_var['table']; ?>->id)<?php echo '?>'; ?>
">编辑</a><?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
</h3>
        <table class="col-list" width="100%" border="1" cellspacing="0" cellpadding="0">
<?php $_from = $this->_var['gallery']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format_0_09034100_1548579362');if (count($_from)):
    foreach ($_from AS $this->_var['field'] => $this->_var['format_0_09034100_1548579362']):
?>
          <tr>
            <th width="100px;" scope="row"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>：</th>
            <td>
<?php echo '<?php'; ?>
 foreach($gallery as $val):<?php echo '?>'; ?>

              <a href="/<?php echo '<?php'; ?>
 echo $val->image;<?php echo '?>'; ?>
" target="_blank"><img width="24" height="24" src="/<?php echo '<?php'; ?>
 echo $val->image;<?php echo '?>'; ?>
"></a>
<?php echo '<?php'; ?>
 endforeach;<?php echo '?>'; ?>

            </td>
          </tr>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </table>
<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

<?php endif; ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>