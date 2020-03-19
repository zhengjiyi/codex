<?php echo '<?php'; ?>
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class <?php echo ucfirst($this->_var['table']); ?>_model extends QD_Model {

    public $table = '<?php echo $this->_var['table']; ?>';
<?php if ($this->_var['primary_key']): ?>
    public $primary_key = '<?php echo $this->_var['primary_key']; ?>';
<?php endif; ?>

    public $attributes = '<?php echo $this->_var['gets']; ?>';
    public $list_attributes = '<?php echo $this->_var['lists']; ?>';
<?php if ($this->_var['alls'] != ""): ?>
    public $option = array('<?php echo $this->_var['alla']['0']; ?>', '<?php echo $this->_var['alla']['1']; ?>');
<?php endif; ?>

    public $rules = array(
<?php $_from = $this->_var['verify']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'type');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['type']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['entry'] [ $this->_var['field'] ] == 'password'): ?>
        array(
            'field'   => '<?php echo $this->_var['field']; ?>',
            'label'   => '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>',
            'rules'   => 'min_length[6]|<?php if ($this->_var['max_lengths'] [ $this->_var['field'] ] > 0): ?>max_length[<?php echo $this->_var['max_lengths'][$this->_var['field']]; ?>]<?php endif; ?>|matches[re<?php echo $this->_var['field']; ?>]<?php if ($this->_var['null'] [ $this->_var['field'] ] == 'NO'): ?>|required<?php endif; ?>'
        ),
        array(
            'field'   => 're<?php echo $this->_var['field']; ?>',
            'label'   => '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>',
            'rules'   => 'min_length[6]|<?php if ($this->_var['max_lengths'] [ $this->_var['field'] ] > 0): ?>max_length[<?php echo $this->_var['max_lengths'][$this->_var['field']]; ?>]<?php endif; ?><?php if ($this->_var['null'] [ $this->_var['field'] ] == 'NO'): ?>|required<?php endif; ?>'
        )<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'select-from-db' || $this->_var['entry'] [ $this->_var['field'] ] == 'radio-from-db' || $this->_var['entry'] [ $this->_var['field'] ] == 'checkbox-from-db' || $this->_var['entry'] [ $this->_var['field'] ] == 'position-province' || $this->_var['entry'] [ $this->_var['field'] ] == 'position-city' || $this->_var['entry'] [ $this->_var['field'] ] == 'position-district' || $this->_var['entry'] [ $this->_var['field'] ] == 'catalog'): ?>
        array(
            'field'   => '<?php echo $this->_var['field']; ?>',
            'label'   => '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>',
            'rules'   => 'is_natural_no_zero<?php if ($this->_var['null'] [ $this->_var['field'] ] == 'NO'): ?>|required<?php endif; ?>'
        )<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'select-from-array' || $this->_var['entry'] [ $this->_var['field'] ] == 'radio-from-array' || $this->_var['entry'] [ $this->_var['field'] ] == 'checkbox-from-array'): ?>
        array(
            'field'   => '<?php echo $this->_var['field']; ?>',
            'label'   => '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>',
            'rules'   => '<?php if ($this->_var['integer'] [ $this->_var['field'] ]): ?>is_natural_no_zero<?php elseif ($this->_var['max_lengths'] [ $this->_var['field'] ] > 0): ?>trim|max_length[<?php echo $this->_var['max_lengths'][$this->_var['field']]; ?>]<?php endif; ?><?php if ($this->_var['null'] [ $this->_var['field'] ] == 'NO'): ?>|required<?php endif; ?>'
        )<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'text' || $this->_var['entry'] [ $this->_var['field'] ] == 'textarea'): ?>
        array(
            'field'   => '<?php echo $this->_var['field']; ?>',
            'label'   => '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>',
            'rules'   => 'trim|max_length[<?php echo $this->_var['max_lengths'][$this->_var['field']]; ?>]<?php if ($this->_var['null'] [ $this->_var['field'] ] == 'NO'): ?>|required<?php endif; ?>'
        )<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php elseif ($this->_var['entry'] [ $this->_var['field'] ] == 'editor' && $this->_var['null'] [ $this->_var['field'] ] == 'NO'): ?>
        array(
            'field'   => '<?php echo $this->_var['field']; ?>',
            'label'   => '<?php echo empty($this->_var['comments'][$this->_var['field']]) ? $this->_var['field'] : $this->_var['comments'][$this->_var['field']]; ?>',
            'rules'   => 'required'
        )<?php if (! ($this->_foreach['seek']['iteration'] == $this->_foreach['seek']['total'])): ?>,<?php endif; ?>

<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    );

    public function __construct()
    {
        parent::__construct();
    }
<?php if ($this->_var['wheres']): ?>
<?php $_from = $this->_var['wheres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('field', 'format');$this->_foreach['seek'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['seek']['total'] > 0):
    foreach ($_from AS $this->_var['field'] => $this->_var['format']):
        $this->_foreach['seek']['iteration']++;
?>
<?php if ($this->_var['entry'] [ $this->_var['field'] ] == 'catalog'): ?>

    public function set_catalog($catalog, $<?php echo $this->_var['field']; ?>) {
        $ids = qd_catalog_ids($catalog, intval($<?php echo $this->_var['field']; ?>));
        if (count($ids) > 1) {
            $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', $ids, 'where_in');
            $this-><?php echo $this->_var['table']; ?>->set_condition('<?php echo $this->_var['field']; ?>', $<?php echo $this->_var['field']; ?>);
        } else {
            $this-><?php echo $this->_var['table']; ?>->set_where('<?php echo $this->_var['field']; ?>', $<?php echo $this->_var['field']; ?>);
        }
    }
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
}

/* End of file <?php echo $this->_var['table']; ?>.php */
/* Location: ./application/models/<?php echo $this->_var['table']; ?>.php */