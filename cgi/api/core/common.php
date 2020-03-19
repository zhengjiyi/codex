<?php

function config_item($k=NULL, $v=NULL) {
	return Polygon::instance()->config($k, $v);
}

function database() {
	static $_db;
	if ( $_db ) return $_db;
	$db_config = config_item('db');
	if ( !include(CORE."db/{$db_config['dbtype']}.php") ) exit("{$db_config['dbtype']} missing");
	$db_type = "db_{$db_config['dbtype']}";
	$_db = new $db_type($db_config['dbhost'], $db_config['dbuser'], $db_config['dbpwd'], $db_config['dbname'], $db_config['pconnect'], $db_config['charset']);
	return $_db;
}

/**
 * 重定向
 * @param string $url
 */
function redirect($url) {
	header("location:{$url}");
	exit;
}
/**
 * 组合站点链接
 * @param string $uri
 * @return string
 */
function base_url($uri = NULL) {
	return config_item('site_url') . $uri;
}

/**
 * 模块链接
 * @param string $uri
 * @return string
 */
function module_url($uri = NULL) {
	$p = Polygon::instance()->plugin();
	$uri = ($p) ? "{$p}/{$uri}" : $uri;
	return config_item('site_url') . $uri;
}

function get($key, $clean=TRUE, $default=NULL) {
	return Polygon::instance()->input($key, $clean, $default);
}

function lang($key) {
	return $key;
}