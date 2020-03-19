<?php
/**
 * api 模块
 * @author paperen<paperen@gmail.com>
 */

return array(
	'status' => 1, // active
	'name' => 'api',

	// 路由规则
	'route' => array(
		'banner' => 'banner/index',
		'search' => 'product/search',
		'product' => 'product/index',
		'product_detail' => 'product/view',
		'series' => 'product/type',
		'tag' => 'tag/index',
		'news' => 'news/index',
		'news_detail' => 'news/view',
		'shop' => 'shop/index',
		'shop_detail' => 'shop/view',
	),
	'debug' => TRUE,
);

