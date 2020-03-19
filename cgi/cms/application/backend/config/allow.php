<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['allow'] = array(
    'admin'=>array(
        'title' =>'管理员管理',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit'),
            'del' => array('del', 'batch')
        )
    ),
    'article'=>array(
        'title'=>'资讯管理',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit', 'seo'),
            'del' => array('del', 'batch')
        )
    ),
    'assist'=>array(
        'title' =>'页面管理',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit'),
            'del' => array('del', 'batch')
        )
    ),
    'catalog'=>array(
        'title'=>'分类目录管理',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('edit', 'save', 'seo'),
            'del' => array('del', 'batch')
        )
    ),
    'groups'=>array(
        'title'=>'用户组管理',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit'),
            'del' => array('del', 'batch')
        )
    ),
    'setup'=>array(
        'title'=>'系统设置',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit'),
            'del' => array('del', 'batch')
        )
    ),
	'banner'=>array(
        'title'=>'首页BANNER',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit'),
            'del' => array('del', 'batch')
        )
    ),
	'product'=>array(
        'title'=>'产品管理',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit'),
            'del' => array('del', 'batch')
        )
    ),
	'product_type'=>array(
		'title'=>'产品系列管理',
		'auth' => array(
			'view' => array('index', 'pages', 'view'),
			'edit' => array('add', 'edit'),
			'del' => array('del', 'batch')
		)
	),
	'tag'=>array(
		'title'=>'标签管理',
		'auth' => array(
			'view' => array('index', 'pages', 'view'),
			'edit' => array('add', 'edit'),
			'del' => array('del', 'batch')
		)
	),
	'tag_type'=>array(
		'title'=>'标签类别管理',
		'auth' => array(
			'view' => array('index', 'pages', 'view'),
			'edit' => array('add', 'edit'),
			'del' => array('del', 'batch')
		)
	),
	'news'=>array(
        'title'=>'新闻动态',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit'),
            'del' => array('del', 'batch')
        )
    ),
	'video'=>array(
        'title'=>'视频管理',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit'),
            'del' => array('del', 'batch')
        )
    ),
	'shop'=>array(
        'title'=>'门店管理',
        'auth' => array(
            'view' => array('index', 'pages', 'view'),
            'edit' => array('add', 'edit'),
            'del' => array('del', 'batch')
        )
    ),
);