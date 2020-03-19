<?php
/**
 * polygon
 * @author paperen<paperen@gmail.com>
 */

return array(
	'develop' => array(
		'db' => array(
			'dbtype' => 'mysqli',
			'dbhost' => '127.0.0.1',
			'pconnect' => FALSE,
			'dbuser' => 'root',
			'dbpwd' => '',
			'dbname' => 'codex',
			'charset' => 'utf8',
			'prefix' => 'codex_'
		),
		'checkplugin' => FALSE,
		'app_name' => 'codex',
		'site_url' => 'http://localhost/oramage/codex/cgi/',
	),
	'test' => array(
		'db' => array(
			'dbtype' => 'mysqli',
			'dbhost' => 'xdm70729545.my3w.com',
			'pconnect' => FALSE,
			'dbuser' => 'xdm70729545',
			'dbpwd' => 'CODEXwatch2019',
			'dbname' => 'xdm70729545_db',
			'charset' => 'utf8',
			'prefix' => 'codex_'
		),
		'checkplugin' => FALSE,
		'app_name' => 'sfbest',
		'site_url' => 'http://www.codex-watch.ch/',
	),
	'production' => array(

	),
);

