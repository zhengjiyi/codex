<?php
class tag extends Model
{
	protected $_pk = 'id';
	protected $_fields = array(
		'id' => '',
		'tag' => '',
		'tag_type_id' => '',
		'tag_en' => '',
	);
	protected $_table_name = 'tag';
	protected $_table_prefix = 'codex_';

	public function all($limit = 0, $offset = 0)
	{
		$table = $this->_table_name('tag');
		$ttable = $this->_table_name('tag_type');
		$sql = "select t.*,tt.typename,tt.typename_en from {$table} as t join {$ttable} as tt on tt.id=t.tag_type_id order by tt.ord desc,tt.id desc";
		return $this->db->select($sql);
	}
}