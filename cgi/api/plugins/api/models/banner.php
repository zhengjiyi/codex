<?php
class banner extends Model
{
	protected $_pk = 'id';
	protected $_fields = array(
		'id' => '',
		'img' => '',
		'ord' => '',
		'title_cn1' => '',
		'title_en1' => '',
		'title_cn2' => '',
		'title_en2' => '',
		'url_cn' => '',
		'url_en' => '',
		'type' => '',
		'video' => '',
	);
	protected $_table_name = 'banner';
	protected $_table_prefix = 'codex_';
	
	public function all( $limit = 0, $offset = 0 ) {
		$tablename = $this->_table_name();
		$fields = implode( '`,`', $this->_fields() );
		$key = $this->_primary_key();
		$sql = "select `{$fields}` from {$tablename} order by ord desc";
		if ( $limit ) $sql .= " limit {$offset},{$limit}";
		return $this->db->select( $sql );
	}
}