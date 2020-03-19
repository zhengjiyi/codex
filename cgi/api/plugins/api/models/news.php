<?php
class news extends Model
{
	protected $_pk = 'id';
	protected $_fields = array(
		'id' => '',
		'img' => '',
		'pub_date' => '',
		'title_cn' => '',
		'content_cn' => '',
		'title_en' => '',
		'content_en' => '',
	);
	protected $_table_name = 'news';
	protected $_table_prefix = 'codex_';

	public function all($limit = 0, $offset = 0, $keyword=NULL, $lang='cn')
	{
		if ( $offset < 0 ) $offset = 0;
		$table = $this->_table_name($this->_table_name);
		$sql = "select id,img,pub_date,title_cn,title_en from {$table} where 1";
		if ( $keyword ) {
			if ( $lang == 'cn' ) {
				$sql .= " and (title_cn like '%{$keyword}%' or MATCH(content_cn,content_en) AGAINST('{$keyword}'))";
			} else {
				$sql .= " and (title_en like '%{$keyword}%' or MATCH(content_cn,content_en) AGAINST('{$keyword}'))";
			}
		}
		$sql .= " order by pub_date desc";
		if ( $limit ) $sql .= " limit {$offset},{$limit}";
		return $this->db->select($sql);
	}

	public function get_by_pk( $pk ) {
		$tablename = $this->_table_name();
		$fields = 'id,img,pub_date,title_cn,title_en,content_cn,content_en';
		$key = $this->_primary_key();
		$sql = "select {$fields} from {$tablename} where `{$key}`='{$pk}'";
		return $this->db->get_one($sql);
	}
}