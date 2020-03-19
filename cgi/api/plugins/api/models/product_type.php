<?php
class product_type extends Model
{
	protected $_pk = 'id';
	protected $_fields = array(
		'id' => '',
		'type_name' => '',
		'type_name_en' => '',
		'image' => '',
	);
	protected $_table_name = 'product_type';
	protected $_table_prefix = 'codex_';
}