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
<?php if ($this->_var['wheres'] && ( $this->_var['catalog'] || $this->_var['position'] || $this->_var['date'] )): ?>
<?php $_from = $this->_var['wheres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');if (count($_from)):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
?>
<?php if ($this->_var['catalog'] && $this->_var['entry'] [ $this->_var['field'] ] == 'catalog'): ?>
<script src="<?php echo '<?php'; ?>
 echo base_url('js/jquery.qd.catalog.js')<?php echo '?>'; ?>
" type="text/javascript"></script>
<?php elseif ($this->_var['date'] && $this->_var['entry'] [ $this->_var['field'] ] == 'date'): ?>
<link href="<?php echo '<?php'; ?>
 echo base_url('css/jquery/jquery.ui.core.css')<?php echo '?>'; ?>
" rel="stylesheet" type="text/css" />
<link href="<?php echo '<?php'; ?>
 echo base_url('css/jquery/jquery.ui.theme.css')<?php echo '?>'; ?>
" rel="stylesheet" type="text/css" />
<link href="<?php echo '<?php'; ?>
 echo base_url('css/jquery/jquery.ui.datepicker.css')<?php echo '?>'; ?>
" rel="stylesheet" type="text/css" />
<script src="<?php echo '<?php'; ?>
 echo base_url('js/jquery.ui.core.js')<?php echo '?>'; ?>
" type="text/javascript"></script>
<script src="<?php echo '<?php'; ?>
 echo base_url('js/jquery.ui.datepicker.js')<?php echo '?>'; ?>
" type="text/javascript"></script>
<script src="<?php echo '<?php'; ?>
 echo base_url('js/jquery.ui.datepicker-zh-CN.js')<?php echo '?>'; ?>
" type="text/javascript"></script>
<?php elseif ($this->_var['position'] && $this->_var['entry'] [ $this->_var['field'] ] == 'position-province' || $this->_var['position'] && $this->_var['entry'] [ $this->_var['field'] ] == 'position-city' || $this->_var['position'] && $this->_var['entry'] [ $this->_var['field'] ] == 'position-district'): ?>
<script src="<?php echo '<?php'; ?>
 echo base_url('js/jquery.qd.region.js')<?php echo '?>'; ?>
" type="text/javascript"></script>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
<script src="<?php echo '<?php'; ?>
 echo base_url('js/overall.js')<?php echo '?>'; ?>
" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
var base_url = '<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>')<?php echo '?>'; ?>
';
</script>
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
<?php echo '<?php'; ?>
 if (qd_func_auth('add', $auth['<?php echo $this->_var['table']; ?>'], 'edit')): <?php echo '?>'; ?>

      <div>
        <a class="btn" href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/add')<?php echo '?>'; ?>
"><span>添加<?php echo empty($this->_var['comment']) ? $this->_var['table'] : $this->_var['comment']; ?></span></a>
      </div>
<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

    </div>
    <div id="panel">
<?php if ($this->_var['wheres']): ?>
      <div id="headbar">
        <div id="topsearch">
          <form id="seachform" name="seachform" method="get" action="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/pages')<?php echo '?>'; ?>
">
<?php $_from = $this->_var['wheres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');if (count($_from)):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
?>
<?php if ($this->_var['entry'] [ $this->_var['field'] ] == 'text'): ?>
            <input name="<?php echo $this->_var['field']; ?>" type="text" class="input-txt short" id="<?php echo $this->_var['field']; ?>" title="<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>" onfocus="javascript:if(this.value == '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>') this.value = '';" value="<?php echo '<?php'; ?>
 echo empty($where['<?php echo $this->_var['field']; ?>'])?'<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>':$where['<?php echo $this->_var['field']; ?>']<?php echo '?>'; ?>
" />
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'catalog'): ?>
            <select id="<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>" for="<?php echo $this->_var['field']; ?>" default="<?php echo '<?php'; ?>
 echo qd_trace_catalog($<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>, $where['<?php echo $this->_var['field']; ?>']);<?php echo '?>'; ?>
">
              <option value="">选择<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?></option>
            </select>
            <input type="hidden" name="<?php echo $this->_var['field']; ?>" id="<?php echo $this->_var['field']; ?>" class="catalog" title="<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>" value="<?php echo '<?php'; ?>
 echo $where['<?php echo $this->_var['field']; ?>'];<?php echo '?>'; ?>
" />
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'select-from-db' || $this->_var['entry'] [ $this->_var['field'] ] == 'radio-from-db' || $this->_var['entry'] [ $this->_var['field'] ] == 'checkbox-from-db'): ?>
            <select name="<?php echo $this->_var['field']; ?>" id="<?php echo $this->_var['field']; ?>">
              <option value=""><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?></option>
<?php echo '<?php'; ?>
 foreach($<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?> as $k => $v):<?php echo '?>'; ?>

              <option<?php echo '<?php'; ?>
 if(isset($where['<?php echo $this->_var['field']; ?>']) && $where['<?php echo $this->_var['field']; ?>'] == $k) echo ' selected="selected"'<?php echo '?>'; ?>
 value="<?php echo '<?php'; ?>
 echo $k;<?php echo '?>'; ?>
"><?php echo '<?php'; ?>
 echo $v;<?php echo '?>'; ?>
</option>
<?php echo '<?php'; ?>
 endforeach;<?php echo '?>'; ?>

            </select>
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'select-from-array' || $this->_var['entry'] [ $this->_var['field'] ] == 'radio-from-array' || $this->_var['entry'] [ $this->_var['field'] ] == 'checkbox-from-array'): ?>
            <select name="<?php echo $this->_var['field']; ?>" id="<?php echo $this->_var['field']; ?>">
              <option value=""><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?></option>
<?php echo '<?php'; ?>
 foreach($<?php echo $this->_var['field']; ?> as $k => $v):<?php echo '?>'; ?>

              <option<?php echo '<?php'; ?>
 if(isset($where['<?php echo $this->_var['field']; ?>']) && $where['<?php echo $this->_var['field']; ?>'] == $k) echo ' selected="selected"'<?php echo '?>'; ?>
 value="<?php echo '<?php'; ?>
 echo $k;<?php echo '?>'; ?>
"><?php echo '<?php'; ?>
 echo $v;<?php echo '?>'; ?>
</option>
<?php echo '<?php'; ?>
 endforeach;<?php echo '?>'; ?>

            </select>
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'date'): ?>
            <input type="text" class="input-txt short" style="z-index:1000;position:relative;" name="<?php echo $this->_var['field']; ?>" id="<?php echo $this->_var['field']; ?>" title="<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>" onfocus="javasctipt:if(this.value == '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>') this.value = '';" value="<?php echo '<?php'; ?>
 echo empty($where['<?php echo $this->_var['field']; ?>'])?'<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>':$where['<?php echo $this->_var['field']; ?>']<?php echo '?>'; ?>
" />
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'addtime'): ?>
            <input type="text" class="input-txt short" style="z-index:1000;position:relative;" name="<?php echo $this->_var['field']; ?>" id="<?php echo $this->_var['field']; ?>" title="<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>" onfocus="javasctipt:if(this.value == '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>') this.value = '';" value="<?php echo '<?php'; ?>
 echo empty($where['<?php echo $this->_var['field']; ?>'])?'<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>':$where['<?php echo $this->_var['field']; ?>']<?php echo '?>'; ?>
" />
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'position-province'): ?>
            <select id="<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_province"><option value="">省份</option></select>
            <input type="hidden" name="<?php echo $this->_var['field']; ?>" id="<?php echo $this->_var['field']; ?>" value="<?php echo '<?php'; ?>
 echo $where['<?php echo $this->_var['field']; ?>'];<?php echo '?>'; ?>
" />
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'position-city'): ?>
            <select id="<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_province"><option value="">省份</option></select>
            <select id="<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_city" style="display:none"><option value="">城市</option></select>
            <input type="hidden" name="<?php echo $this->_var['field']; ?>" id="<?php echo $this->_var['field']; ?>" value="<?php echo '<?php'; ?>
 echo $where['<?php echo $this->_var['field']; ?>'];<?php echo '?>'; ?>
" />
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'position-district'): ?>
            <select id="<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_province"><option value="">省份</option></select>
            <select id="<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_city" style="display:none"><option value="">城市</option></select>
            <select id="<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_district" style="display:none"><option value="">区县</option></select>
            <input type="hidden" name="<?php echo $this->_var['field']; ?>" id="<?php echo $this->_var['field']; ?>" value="<?php echo '<?php'; ?>
 echo $where['<?php echo $this->_var['field']; ?>'];<?php echo '?>'; ?>
" />
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <button id="search" class="input-btn" type="submit">搜索</button>
          </form>
        </div>
        <div id="toppage"><?php echo '<?php'; ?>
 echo $paging->tinylinks();<?php echo '?>'; ?>
</div>
      </div>
<?php else: ?>
      <div class="clear"></div>
<?php endif; ?>
      <div id="subpanel">
        <form id="listform" name="listform" method="post" action="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/batch/del')<?php echo '?>'; ?>
">
        <table class="row-list" width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th scope="col">全选<input type="checkbox" name="checkAll" id="checkAll" /></th>
<?php $_from = $this->_var['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['field'] != 'id'): ?>
<?php if ($this->_var['sort'] [ $this->_var['field'] ]): ?>
              <th scope="col"><?php echo '<?php'; ?>
 echo qd_order_by('<?php echo $this->_var['table']; ?>/pages', $paging->query, '<?php echo $this->_var['field']; ?>', '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>')<?php echo '?>'; ?>
</th>
<?php elseif ($this->_var['field'] == 'position'): ?>
              <th scope="col">区域</th>
<?php else: ?>
              <th scope="col"><?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?></th>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <th scope="col">操作</th>
            </tr>
          </thead>
<?php echo '<?php'; ?>
 if (empty($list)): <?php echo '?>'; ?>

            <tbody>
              <tr>
                <td colspan="<?php echo $this->_var['col']; ?>">暂未添加<?php echo empty($this->_var['comment']) ? $this->_var['table'] : $this->_var['comment']; ?>：<a href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/add')<?php echo '?>'; ?>
">添加</a></td>
              </tr>
            </tbody>
<?php echo '<?php'; ?>
 else: <?php echo '?>'; ?>

          <tbody>
<?php echo '<?php'; ?>
 foreach($list as $k=>$row):<?php echo '?>'; ?>

            <tr id="<?php echo '<?php'; ?>
 echo $row->id;<?php echo '?>'; ?>
">
              <td><input type="checkbox" name="<?php echo $this->_var['table']; ?>[<?php echo '<?php'; ?>
 echo $row->id;<?php echo '?>'; ?>
]" id="<?php echo $this->_var['table']; ?>_<?php echo '<?php'; ?>
 echo $row->id;<?php echo '?>'; ?>
" value="<?php echo '<?php'; ?>
 echo $row->id;<?php echo '?>'; ?>
" class="checkIt" /></td>
<?php $_from = $this->_var['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'format');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['format']):
?>
<?php if ($this->_var['key'] != 'id'): ?>
<?php if ($this->_var['entry'] [ $this->_var['key'] ] == 'catalog'): ?>
              <td><?php echo '<?php'; ?>
 echo isset($<?php echo substr($this->_var['key'], 0, strrpos($this->_var['key'], "_id")); ?>[$row-><?php echo $this->_var['key']; ?>]) ? $<?php echo substr($this->_var['key'], 0, strrpos($this->_var['key'], "_id")); ?>[$row-><?php echo $this->_var['key']; ?>]['name'] : '未分配';<?php echo '?>'; ?>
</td>
<?php elseif ($this->_var['entry'] [ $this->_var['key'] ] == 'select-from-array' || $this->_var['entry'] [ $this->_var['key'] ] == 'radio-from-array' || $this->_var['entry'] [ $this->_var['key'] ] == 'checkbox-from-array'): ?>
              <td><?php echo '<?php'; ?>
 echo isset($<?php echo $this->_var['key']; ?>[$row-><?php echo $this->_var['key']; ?>]) ? $<?php echo $this->_var['key']; ?>[$row-><?php echo $this->_var['key']; ?>] : '未分配';<?php echo '?>'; ?>
</td>
<?php elseif ($this->_var['entry'] [ $this->_var['key'] ] == 'select-from-db' || $this->_var['entry'] [ $this->_var['key'] ] == 'radio-from-db' || $this->_var['entry'] [ $this->_var['key'] ] == 'checkbox-from-db'): ?>
              <td><?php echo '<?php'; ?>
 echo isset($<?php echo substr($this->_var['key'], 0, strrpos($this->_var['key'], "_id")); ?>[$row-><?php echo $this->_var['key']; ?>]) ? $<?php echo substr($this->_var['key'], 0, strrpos($this->_var['key'], "_id")); ?>[$row-><?php echo $this->_var['key']; ?>] : '未分配';<?php echo '?>'; ?>
</td>
<?php elseif ($this->_var['entry'] [ $this->_var['key'] ] == 'switch'): ?>
              <td><a id="<?php echo '<?php'; ?>
 echo $row->id;<?php echo '?>'; ?>
" name="<?php echo $this->_var['key']; ?>" class="switchIt" status="<?php echo '<?php'; ?>
 echo $row-><?php echo $this->_var['key']; ?>;<?php echo '?>'; ?>
" href="javascript:void(0)"><?php echo '<?php'; ?>
 echo $<?php echo $this->_var['key']; ?>[$row-><?php echo $this->_var['key']; ?>];<?php echo '?>'; ?>
</a></td>
<?php elseif ($this->_var['entry'] [ $this->_var['key'] ] == 'enabled'): ?>
              <td><a id="<?php echo '<?php'; ?>
 echo $row->id;<?php echo '?>'; ?>
" class="setEnabled" status="<?php echo '<?php'; ?>
 echo $row-><?php echo $this->_var['key']; ?>;<?php echo '?>'; ?>
" href="javascript:void(0)"><?php echo '<?php'; ?>
 echo $<?php echo $this->_var['key']; ?>[$row-><?php echo $this->_var['key']; ?>];<?php echo '?>'; ?>
</a></td>
<?php elseif ($this->_var['entry'] [ $this->_var['key'] ] == 'image' || $this->_var['entry'] [ $this->_var['key'] ] == 'gallery'): ?>
              <td><?php echo '<?php'; ?>
 if ($row-><?php echo $this->_var['key']; ?>):<?php echo '?>'; ?>
<a href="/<?php echo '<?php'; ?>
 echo $row-><?php echo $this->_var['key']; ?>;<?php echo '?>'; ?>
" target="_blank"><img width="24" height="24" src="/<?php echo '<?php'; ?>
 echo $row-><?php echo $this->_var['key']; ?>;<?php echo '?>'; ?>
"></a><?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
</td>
<?php elseif ($this->_var['entry'] [ $this->_var['key'] ] == 'addtime'): ?>
              <td><?php echo '<?php'; ?>
 echo date('Y-m-d', $row-><?php echo $this->_var['key']; ?>);<?php echo '?>'; ?>
</td>
<?php elseif ($this->_var['entry'] [ $this->_var['key'] ] == 'timestamp'): ?>
              <td><?php echo '<?php'; ?>
 echo date('Y-m-d', strtotime($row-><?php echo $this->_var['key']; ?>));<?php echo '?>'; ?>
</td>
<?php elseif ($this->_var['entry'] [ $this->_var['key'] ] == 'position'): ?>
              <td><?php echo '<?php'; ?>
 echo qd_position(<?php $_from = $this->_var['position']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>$row-><?php echo $this->_var['field']; ?><?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>, <?php endif; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>);<?php echo '?>'; ?>
</td>
<?php else: ?>
              <td><?php echo '<?php'; ?>
 echo $row-><?php echo $this->_var['key']; ?>;<?php echo '?>'; ?>
</td>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <td><a href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/view/'.$row-><?php echo $this->_var['fields']['0']; ?>)<?php echo '?>'; ?>
">查看</a>
<?php echo '<?php'; ?>
 if (qd_func_auth('edit', $auth['<?php echo $this->_var['table']; ?>'], 'edit')): <?php echo '?>'; ?>

                | <a href="<?php echo '<?php'; ?>
 echo base_url('<?php echo $this->_var['table']; ?>/edit/'.$row-><?php echo $this->_var['fields']['0']; ?>)<?php echo '?>'; ?>
">编辑</a>
<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

<?php echo '<?php'; ?>
 if (qd_func_auth('del', $auth['<?php echo $this->_var['table']; ?>'], 'del')): <?php echo '?>'; ?>

                | <a id="<?php echo '<?php'; ?>
 echo $row-><?php echo $this->_var['fields']['0']; ?>;<?php echo '?>'; ?>
" title="<?php echo empty($this->_var['comment']) ? $this->_var['table'] : $this->_var['comment']; ?>:<?php echo '<?php'; ?>
 echo $row-><?php echo $this->_var['fields']['1']; ?>;<?php echo '?>'; ?>
" class="delIt" href="javascript:void(0)">删除</a>
<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

              </td>
            </tr>
<?php echo '<?php'; ?>
 endforeach;<?php echo '?>'; ?>

          </tbody>
<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

        </table>
        <div id="footbar">
          <div id="action"><button id="delChecked" type="button">删除选中</button></div>
          <div id="paging"><?php echo '<?php'; ?>
 echo $paging->links();<?php echo '?>'; ?>
</div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php if ($this->_var['wheres'] && ( $this->_var['catalog'] || $this->_var['position'] || $this->_var['date'] )): ?>
<script language="javascript" type="text/javascript">
$().ready(function() {
<?php if ($this->_var['catalog']): ?>
<?php $_from = $this->_var['catalog']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');if (count($_from)):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
?>
    $( "#<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>" ).catalog(<?php echo '<?php'; ?>
 echo qd_format_catalog($<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>);<?php echo '?>'; ?>
);
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
<?php $_from = $this->_var['wheres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');if (count($_from)):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
?>
<?php if ($this->_var['date'] && $this->_var['entry'] [ $this->_var['field'] ] == 'date'): ?>
    $( "#<?php echo $this->_var['field']; ?>" ).datepicker({
        changeMonth: true,
        changeYear: true
    }, "showAnim", "slideDown");
<?php elseif ($this->_var['position'] && $this->_var['entry'] [ $this->_var['field'] ] == 'position-province'): ?>
    $.region({province:$("#<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_province")}, region:$("#<?php echo $this->_var['field']; ?>"));
<?php elseif ($this->_var['position'] && $this->_var['entry'] [ $this->_var['field'] ] == 'position-city'): ?>
    $.region({province:$("#<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_province"), city:$("#<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_city"), region:$("#<?php echo $this->_var['field']; ?>")});
<?php elseif ($this->_var['position'] && $this->_var['entry'] [ $this->_var['field'] ] == 'position-district'): ?>
    $.region({province:$("#<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_province"), city:$("#<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_city"), district:$("#<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>_district"), region:$("#<?php echo $this->_var['field']; ?>")});
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
});
</script>
<?php endif; ?>
</body>
</html>