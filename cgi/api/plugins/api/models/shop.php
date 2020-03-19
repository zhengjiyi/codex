<?php
class shop extends Model
{
	protected $_pk = 'id';
	protected $_fields = array(
		'id' => '',
		'shop_cn' => '',
		'shop_en' => '',
		'address_cn' => '',
		'address_en' => '',
		'province' => '',
		'province_en' => '',
		'city' => '',
		'city_en' => '',
		'country' => '',
		'country_en' => '',
		'tel' => '',
		'img' => '',
		'offer_time' => '',
		'offer_time_en' => '',
	);
	protected $_table_name = 'shop';
	protected $_table_prefix = 'codex_';

	public function all($limit = 0, $offset = 0, $province=NULL, $city=NULL)
	{
		$tablename = $this->_table_name();
		$fields = implode( '`,`', $this->_fields() );
		$key = $this->_primary_key();
		$sql = "select `{$fields}` from {$tablename}";
		if ( $province ) $sql .= " where province='{$province}'";
		if ( $city ) $sql .= " where city='{$city}'";
		if ( $limit ) $sql .= " limit {$offset},{$limit}";
		return $this->db->select( $sql );
	}
}