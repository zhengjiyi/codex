<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upbase_path'] = '../../';
$config['upload_path'] = 'uploads/';

$config['types'] = array(
    'zip' => '|zip|rar|7z|tgz|tar|gz',
    'docs' => 'doc|docx|rtf|pdf',
    'image' => 'jpg|jpeg|png|gif',
	'video' => 'mp4',
);

$config['article'] = array(
    'image' => array(
        'directory' => 'sub',
        'upload_config' => array(
            'allowed_types' => $config['types']['image'],
            'max_size' => '166048',
            'encrypt_name' => TRUE
        ),
        'resize_config' => array(
            'create_thumb' => TRUE,
            'maintain_ratio' => TRUE,
            'scale' => array(
                's' => array(
                    'width' => 600,
                    'height' => 450
                ),
                't' => array(
                    'width' => 200, 
                    'height' => 150
                )
            )
        )
    ),
    'origin' => array(
        'directory' => 'sub',
        'upload_config' => array(
            'allowed_types' => $config['types']['image'],
            'max_size' => '2048',
            'encrypt_name' => TRUE
        )
    )
);

$config['banner'] = array(
    'img' => array(
        'directory' => 'banner',
        'upload_config' => array(
            'allowed_types' => $config['types']['image'],
            'max_size' => '166048',
            'encrypt_name' => TRUE
        ),
    ),
	'video' => array(
		'directory' => 'video',
		'upload_config' => array(
			'allowed_types' => $config['types']['video'],
			'max_size' => '366048',
			'encrypt_name' => TRUE
		),
	),
);
$config['news'] = array(
    'img' => array(
        'directory' => 'news',
        'upload_config' => array(
            'allowed_types' => $config['types']['image'],
            'max_size' => '166048',
            'encrypt_name' => TRUE
        ),
    ),
	'imgFile' => array(
		'directory' => 'news',
		'upload_config' => array(
			'allowed_types' => $config['types']['image'],
			'max_size' => '166048',
			'encrypt_name' => TRUE
		),
	),
);
$config['product'] = array(
	'img' => array(
		'directory' => 'product',
		'upload_config' => array(
			'allowed_types' => $config['types']['image'],
			'max_size' => '166048',
			'encrypt_name' => TRUE
		),
	),
	'ad_img' => array(
		'directory' => 'product_ad',
		'upload_config' => array(
			'allowed_types' => $config['types']['image'],
			'max_size' => '166048',
			'encrypt_name' => TRUE
		),
	),
);
$config['product_type'] = array(
	'image' => array(
		'directory' => 'product_type',
		'upload_config' => array(
			'allowed_types' => $config['types']['image'],
			'max_size' => '166048',
			'encrypt_name' => TRUE
		),
	),
);
$config['video'] = array(
    'img' => array(
        'directory' => 'video',
        'upload_config' => array(
            'allowed_types' => $config['types']['image'],
            'max_size' => '166048',
            'encrypt_name' => TRUE
        ),
    ),
);
$config['shop'] = array(
    'img' => array(
        'directory' => 'shop',
        'upload_config' => array(
            'allowed_types' => $config['types']['image'],
            'max_size' => '166048',
            'encrypt_name' => TRUE
        ),
    ),
);
