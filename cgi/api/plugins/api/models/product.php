<?php
class product extends Model
{
	protected $_pk = 'id';
	protected $_fields = array(
		'id' => '',
		'model' => '',
		'product_type' => '',
		'img' => '',
		'ad_img' => '',
		'buy_link' => '',
		'price' => '',
		'price_en' => '',
		'jx_cn' => '',
		'jx_en' => '',
		'gn_cn' => '',
		'gn_en' => '',
		'bk_cn' => '',
		'bk_en' => '',
		'bj_cn' => '',
		'bj_en' => '',
		'dg_cn' => '',
		'dg_en' => '',
		'bp_cn' => '',
		'bp_en' => '',
		'bd_cn' => '',
		'bd_en' => '',
		'bkzj_cn' => '',
		'bkzj_en' => '',
		'fs_cn' => '',
		'fs_en' => '',
		'tag' => '',
	);
	protected $_table_name = 'product';
	protected $_table_prefix = 'codex_';

	public function all($limit = 0, $offset = 0, $typeid=NULL, $tag=NULL, $keyword=NULL, $lang='cn')
	{
		$offset = ( $offset < 0 ) ? 0 : $offset;
		$table = $this->_table_name('product');
		$ttable = $this->_table_name('product_type');
		$sql = "select t.id,t.model,t.product_type,t.img,t.ad_img,t.buy_link,t.price,t.price_en,t.tag,tt.type_name as type,tt.type_name_en as type_en from {$table} as t join {$ttable} as tt on tt.id=t.product_type where 1";
		if ( $typeid ) $sql .= " and t.product_type='{$typeid}'";
		if ( $tag ) {
			$tmp = array();
			foreach( $tag as $v ) $tmp[] = " FIND_IN_SET('{$v}', t.tag) ";
			$sql .= ' and (' . implode('or', $tmp) . ')';
		}
		if ( $keyword ) {
			if ( $lang == 'cn' ) {
				$sql .= " and (t.model like '%{$keyword}%' or tt.type_name like '%{$keyword}%')";
			} else {
				$sql .= " and (t.model like '%{$keyword}%' or tt.type_name_en like '%{$keyword}%')";
			}
		}
		$sql .= " order by t.ord desc,t.id desc";
		if ( $limit ) $sql .= " limit {$offset},{$limit}";
		return $this->db->select($sql);
	}

	public function get_by_pk($pk)
	{
		$table = $this->_table_name('product');
		$ttable = $this->_table_name('product_type');
		$sql = "select t.*,tt.type_name as type,tt.type_name_en as type_en from {$table} as t join {$ttable} as tt on tt.id=t.product_type where t.id ='{$pk}'";
		return $this->db->get_one($sql);
	}

	public function recommend($current, $typeid=NULL, $limit=3)
	{
		$table = $this->_table_name('product');
		$ttable = $this->_table_name('product_type');
		$sql = "select t.id,t.model,t.product_type,t.img,t.ad_img,t.buy_link,t.price,t.price_en,t.tag,tt.type_name as type,tt.type_name_en as type_en from {$table} as t join {$ttable} as tt on tt.id=t.product_type where t.id !='{$current}'";
		if ($typeid) {
			$sql .= " and t.product_type='{$typeid}'";
		}
		$sql .= " order by id desc";
		if ($limit) {
			$sql .= " limit {$limit}";
		}
		return $this->db->select($sql);
	}
	
	public function total($typeid='', $tag='') {
		$tablename = $this->_table_name();
		$sql = "select count(*) from `{$tablename}` where 1";
		if ( $typeid ) $sql .= " and product_type='{$typeid}'";
		if ( $tag ) {
			foreach( $tag as $v ) {
				$sql .= " and FIND_IN_SET('{$v}', tag)";
			}
		}
		$r = $this->db->get_one($sql);
		return $r['count(*)'];
	}
}