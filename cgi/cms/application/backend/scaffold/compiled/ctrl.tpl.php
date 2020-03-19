<?php echo '<?php'; ?>
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class <?php echo ucfirst($this->_var['table']); ?> extends QD_Controller {

    public $per_page = 20;

    function __construct()
    {
        parent::__construct();
        $this->data['current'] = '<?php echo empty($this->_var['comment']) ? $this->_var['table'] : $this->_var['comment']; ?>';
        $this->data['items'] = array('edit' => '基本信息'<?php if ($this->_var['gallery']): ?>, 'gallery' => '图集管理'<?php endif; ?><?php if ($this->_var['seo']): ?>, 'seo' => 'SEO设置'<?php endif; ?>);
<?php if ($this->_var['entry']): ?>
<?php $_from = $this->_var['entry']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['format'] == 'select-from-array' || $this->_var['format'] == 'radio-from-array' || $this->_var['format'] == 'checkbox-from-array' || $this->_var['format'] == 'switch'): ?>
        $this->data['<?php echo $this->_var['field']; ?>'] = array(<?php echo $this->_var['array'][$this->_var['field']]; ?>);
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
    }

    /**
     * 首页
     * @return  Output a view
     */
    public function index()
    {
        $this->pages();
    }

    /**
     * 列表页
     * @param   Integer
     * @return  Output a view
     */
    public function pages($cur_page = 0)
    {
<?php if ($this->_var['position']): ?>
        $this->load->helper('region');
<?php endif; ?>
        //获取结果集
        $this->load->model('<?php echo ucfirst($this->_var['table']); ?>_model', '<?php echo $this->_var['table']; ?>');
<?php if ($this->_var['wheres']): ?>
<?php $_from = $this->_var['wheres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['entry'] [ $this->_var['field'] ] == 'text'): ?>
        $this-><?php echo $this->_var['table']; ?>->set_like('<?php echo $this->_var['field']; ?>', $this->input->get('<?php echo $this->_var['field']; ?>'));
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'catalog'): ?>
        //分类查询
        $catalog = $this->catalog('<?php echo $this->_var['table']; ?>');
        $this-><?php echo $this->_var['table']; ?>->set_catalog($catalog, $this->input->get('catalog_id'));
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'select-from-db' || $this->_var['entry'] [ $this->_var['field'] ] == 'radio-from-db' || $this->_var['entry'] [ $this->_var['field'] ] == 'checkbox-from-db'): ?>
        $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', $this->input->get('<?php echo $this->_var['field']; ?>'));
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'select-from-array' || $this->_var['entry'] [ $this->_var['field'] ] == 'radio-from-array' || $this->_var['entry'] [ $this->_var['field'] ] == 'checkbox-from-array'): ?>
        $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', $this->input->get('<?php echo $this->_var['field']; ?>'));
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'switch'): ?>
        $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', $this->input->get('<?php echo $this->_var['field']; ?>'));
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'date'): ?>
        $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', $this->input->get('<?php echo $this->_var['field']; ?>'));
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'addtime'): ?>
        $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', strtotime($this->input->get('<?php echo $this->_var['field']; ?>')));
        $this-><?php echo $this->_var['table']; ?>->set_condition('<?php echo $this->_var['field']; ?>', $this->input->get('<?php echo $this->_var['field']; ?>'));
<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'position-province' || $this->_var['entry'] [ $this->_var['field'] ] == 'position-city' || $this->_var['entry'] [ $this->_var['field'] ] == 'position-district'): ?>
        //地理位置搜索
        if (qd_rigion_level($this->input->get('<?php echo $this->_var['field']; ?>')) == 'district') {
            $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', intval($this->input->get('<?php echo $this->_var['field']; ?>')));
        } else {
            $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', qd_round_up($this->input->get('<?php echo $this->_var['field']; ?>')), 'where', '<');
            $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', intval($this->input->get('<?php echo $this->_var['field']; ?>')), 'where', '>=');
        }
<?php else: ?>
        $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', $this->input->get('<?php echo $this->_var['field']; ?>'));
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
<?php if ($this->_var['sort']): ?>
        //排序
        $this-><?php echo $this->_var['table']; ?>->set_order($this->input->get('order'), 'uptime-desc');
<?php endif; ?>
        $this->data['list'] = $this-><?php echo $this->_var['table']; ?>->list_result($cur_page, $this->per_page);
<?php if ($this->_var['wheres']): ?>
        $this->data['where'] = $this-><?php echo $this->_var['table']; ?>->get_condition();
<?php endif; ?>
        $this->data['paging'] = $this-><?php echo $this->_var['table']; ?>->paging('<?php echo $this->_var['table']; ?>/pages');
<?php if ($this->_var['relation']): ?>
        //加载关联数据
<?php $_from = $this->_var['relation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['entry'] [ $this->_var['field'] ] == 'catalog'): ?>
        $this->data['<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>'] = $catalog;
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php $_from = $this->_var['relation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['entry'] [ $this->_var['field'] ] == 'select-from-db' || $this->_var['entry'] [ $this->_var['field'] ] == 'radio-from-db' || $this->_var['entry'] [ $this->_var['field'] ] == 'checkbox-from-db'): ?>
        $this->load->model('<?php echo ucfirst(substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id"))); ?>_model', '<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>');
        $this->data['<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>'] = $this-><?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>->get_option();
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
        //加载模板
        $this->load->view('<?php echo $this->_var['table']; ?>/list', $this->data);
    }

    /**
     * 查看<?php echo empty($this->_var['comment']) ? $this->_var['table'] : $this->_var['comment']; ?>;
     * @param   Integer
     * @return  Output a view
     */
    public function view($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
<?php if ($this->_var['position']): ?>
            $this->load->helper('region');

<?php endif; ?>
            if ($this->input->get('notice')) {
                $this->load->library('notice');
                if ($notice = $this->notice->getNotice()) {
                    $this->data['notice'] = $notice;
                }
            }

<?php if ($this->_var['entry']): ?>
<?php $_from = $this->_var['entry']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['format'] == 'catalog'): ?>
            $this->data['<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>'] = $this->catalog('<?php echo $this->_var['table']; ?>');

<?php elseif ($this->_var['format'] == 'select-from-db' || $this->_var['format'] == 'radio-from-db' || $this->_var['format'] == 'checkbox-from-db'): ?>
            $this->load->model('<?php echo ucfirst(substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id"))); ?>_model', '<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>');
            $this->data['<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>'] = $this-><?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>->get_option();

<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
<?php if ($this->_var['gallery']): ?>
            //获取图集
            $this->load->model('Gallery_model', 'gallery');
            $this->data['gallery'] = $this->gallery->get_all(array(
                'caller' => '<?php echo $this->_var['table']; ?>',
                'caller_id' => $id
            ), 'serial asc');

<?php endif; ?>
<?php if ($this->_var['seo']): ?>
            $this->load->model('Seo_model', 'seo');
            $this->data['seo'] = $this->seo->get_caller('<?php echo $this->_var['table']; ?>', $id);

<?php endif; ?>
            $this->load->model('<?php echo ucfirst($this->_var['table']); ?>_model', '<?php echo $this->_var['table']; ?>');
            $this->data['<?php echo $this->_var['table']; ?>'] = $this-><?php echo $this->_var['table']; ?>->get($id);
            $this->load->view('<?php echo $this->_var['table']; ?>/view',$this->data);
        }
    }

    /**
     * 添加<?php echo empty($this->_var['comment']) ? $this->_var['table'] : $this->_var['comment']; ?>;
     * @return  Output a view
     */
    public function add()
    {
        $this->load->model('<?php echo ucfirst($this->_var['table']); ?>_model', '<?php echo $this->_var['table']; ?>');
        if ($this-><?php echo $this->_var['table']; ?>->validate()) {
            //数据
            $data = array(
<?php if ($this->_var['entry']): ?>
<?php $_from = $this->_var['entry']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['format'] == 'null' || $this->_var['format'] == 'gallery'): ?>
<?php elseif ($this->_var['format'] == 'addtime'): ?>
                '<?php echo $this->_var['field']; ?>' => time()<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php elseif ($this->_var['seo'] [ $this->_var['field'] ] == 'keywords'): ?>
                '<?php echo $this->_var['field']; ?>' => qd_cleanup($this->input->post('<?php echo $this->_var['field']; ?>'))<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php elseif ($this->_var['upload'] && ( $this->_var['format'] == 'image' || $this->_var['format'] == 'attach' )): ?>
                '<?php echo $this->_var['field']; ?>' => $this->resave('<?php echo $this->_var['field']; ?>')<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php else: ?>
                '<?php echo $this->_var['field']; ?>' => $this->input->post('<?php echo $this->_var['field']; ?>')<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
            );
            //执行
            if ($id = $this-><?php echo $this->_var['table']; ?>->insert($data)) {
<?php if ($this->_var['seo']): ?>
                //添加SEO信息
                $this->load->model('Seo_model', 'seo');
                $this->seo->set('<?php echo $this->_var['table']; ?>', $id, array(
<?php $_from = $this->_var['seo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
                    '<?php echo $this->_var['format']; ?>' => $data['<?php echo $this->_var['field']; ?>'],
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php if ($this->_var['addtime']): ?>
                    'addtime' => $data['addtime']
<?php else: ?>
                    'addtime' => time()
<?php endif; ?>
                ));
<?php endif; ?>
                //通知
                $this->load->library('notice');
                $this->notice->succeed(array(
                    'title' => '<?php echo empty($this->_var['comment']) ? $this->_var['table'] : $this->_var['comment']; ?>添加成功！',
<?php if ($this->_var['gallery']): ?>
                    'location' => '/<?php echo $this->_var['table']; ?>/gallery/'.$id.'?notice=add'
<?php elseif ($this->_var['seo']): ?>
                    'location' => '/<?php echo $this->_var['table']; ?>/seo/'.$id.'?notice=add'
<?php else: ?>
                    'location' => '/<?php echo $this->_var['table']; ?>/view/'.$id.'?notice=add'
<?php endif; ?>
                ));
            }
        } else {
<?php if ($this->_var['entry']): ?>
<?php $_from = $this->_var['entry']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['format'] == 'catalog'): ?>
            $this->data['<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>'] = $this->catalog('<?php echo $this->_var['table']; ?>');

<?php elseif ($this->_var['format'] == 'select-from-db' || $this->_var['format'] == 'radio-from-db' || $this->_var['format'] == 'checkbox-from-db'): ?>
            $this->load->model('<?php echo ucfirst(substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id"))); ?>_model', '<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>');
            $this->data['<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>'] = $this-><?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>->get_option();
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
            $this->load->view('<?php echo $this->_var['table']; ?>/add',$this->data);
        }
    }

    /**
     * 编辑<?php echo empty($this->_var['comment']) ? $this->_var['table'] : $this->_var['comment']; ?>;
     * @param   Integer
     * @return  Output a view
     */
    public function edit($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $this->load->model('<?php echo ucfirst($this->_var['table']); ?>_model', '<?php echo $this->_var['table']; ?>');
<?php if ($this->_var['upload']): ?>
            $<?php echo $this->_var['table']; ?> = $this-><?php echo $this->_var['table']; ?>->get($id);
<?php endif; ?>
            if($this-><?php echo $this->_var['table']; ?>->validate()){
<?php if ($this->_var['entry']): ?>
                //数据
                $data = array(
<?php $_from = $this->_var['entry']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['format'] == 'null' || $this->_var['format'] == 'addtime' || $this->_var['format'] == 'gallery'): ?>
<?php elseif ($this->_var['seo'] [ $this->_var['field'] ] == 'keywords'): ?>
                    '<?php echo $this->_var['field']; ?>' => qd_cleanup($this->input->post('<?php echo $this->_var['field']; ?>'))<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php elseif ($this->_var['upload'] && ( $this->_var['format'] == 'image' || $this->_var['format'] == 'attach' )): ?>
                    '<?php echo $this->_var['field']; ?>' => $this->resave('<?php echo $this->_var['field']; ?>', $<?php echo $this->_var['table']; ?>-><?php echo $this->_var['field']; ?>)<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php else: ?>
                    '<?php echo $this->_var['field']; ?>' => $this->input->post('<?php echo $this->_var['field']; ?>')<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                );
<?php endif; ?>
                //更新
                if ($this-><?php echo $this->_var['table']; ?>->update($id, $data)) {
                    //通知
                    $this->load->library('notice');
                    $this->notice->succeed(array(
                        'title' => '<?php echo empty($this->_var['comment']) ? $this->_var['table'] : $this->_var['comment']; ?>编辑成功！',
                        'location' => '/<?php echo $this->_var['table']; ?>/view/'.$id.'?notice=edit'
                    ));
                }
            } else {
<?php if ($this->_var['upload']): ?>
                $this->data['<?php echo $this->_var['table']; ?>'] = $<?php echo $this->_var['table']; ?>;
<?php else: ?>
                $this->data['<?php echo $this->_var['table']; ?>'] = $this-><?php echo $this->_var['table']; ?>->get($id);
<?php endif; ?>
<?php if ($this->_var['entry']): ?>
<?php $_from = $this->_var['entry']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['format'] == 'catalog'): ?>
                $this->data['<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>'] = $this->catalog('<?php echo $this->_var['table']; ?>');
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php $_from = $this->_var['entry']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['format'] == 'select-from-db' || $this->_var['format'] == 'radio-from-db' || $this->_var['format'] == 'checkbox-from-db'): ?>

                $this->load->model('<?php echo ucfirst(substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id"))); ?>_model', '<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>');
                $this->data['<?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>'] = $this-><?php echo substr($this->_var['field'], 0, strrpos($this->_var['field'], "_id")); ?>->get_option();
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
                $this->load->view('<?php echo $this->_var['table']; ?>/edit', $this->data);
            }
        }
    }
<?php if ($this->_var['gallery']): ?>

    /**
     * 获取图集
     * @param   String
     * @param   Integer
     * @return  Array
     */
    public function gallery($id, $field = '<?php echo $this->_var['field']; ?>')
    {
        if (is_numeric($id) && $id > 0) {
<?php $_from = $this->_var['gallery']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
            parent::gallery($id, '<?php echo $this->_var['field']; ?>');
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            $this->data['caller'] = '<?php echo $this->_var['table']; ?>';
            $this->data['caller_id'] = $id;
            $this->load->view('gallery', $this->data);
        }
    }
<?php endif; ?>
<?php if ($this->_var['gallery'] || $this->_var['seo']): ?>

    /**
     * 回调
     * @param   String
     * @param   Array
     * @return  Output a view
     */
    public function _callback($event, $params = array())
    {
        switch ($event) {
            case 'before_delete':
<?php if ($this->_var['gallery']): ?>
                //删除图集
                $this->load->model('Gallery_model', 'gallery');
                $this->gallery->delete_where(array(
                    'caller' => '<?php echo $this->_var['table']; ?>', 
                    'caller_id' => $params['id']
                ));
<?php endif; ?>
<?php if ($this->_var['seo']): ?>
                //删除SEO信息
                $this->load->model('Seo_model', 'seo');
                $this->seo->delete_where(array(
                    'caller' => '<?php echo $this->_var['table']; ?>', 
                    'caller_id' => $params['id']
                ));
<?php endif; ?>
                break;

            case 'before_batch_delete':
<?php if ($this->_var['gallery']): ?>
                //删除图集
                $this->load->model('Gallery_model', 'gallery');
                $this->gallery->set_where('caller', '<?php echo $this->_var['table']; ?>');
                $this->gallery->set_where('caller_id', $params['ids'], 'where_in');
                $this->gallery->delete_result();
<?php endif; ?>
<?php if ($this->_var['seo']): ?>
                //删除SEO信息
                $this->load->model('Seo_model', 'seo');
                $this->seo->set_where('caller', '<?php echo $this->_var['table']; ?>');
                $this->seo->set_where('caller_id', $params['ids'], 'where_in');
                $this->seo->delete_result();
<?php endif; ?>
                break;

            default:
                # code...
                break;
        }
    }
<?php endif; ?>
}

/* End of file <?php echo $this->_var['table']; ?>.php */
/* Location: ./application/controllers/<?php echo $this->_var['table']; ?>.php */