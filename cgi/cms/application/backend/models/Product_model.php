<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends QD_Model {

    public $table = 'product';
    public $primary_key = 'id';

    public $attributes = '';
    public $list_attributes = 'id, model, product_type, img, price, ord';
    public $option = array('tag', '');

    public $rules = array(
        array(
            'field'   => 'model',
            'label'   => 'model',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'buy_link',
            'label'   => 'buy_link',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'jx_cn',
            'label'   => 'jx_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'jx_en',
            'label'   => 'jx_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'gn_cn',
            'label'   => 'gn_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'gn_en',
            'label'   => 'gn_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bk_cn',
            'label'   => 'bk_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bk_en',
            'label'   => 'bk_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bj_cn',
            'label'   => 'bj_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bj_en',
            'label'   => 'bj_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'dg_cn',
            'label'   => 'dg_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'dg_en',
            'label'   => 'dg_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bp_cn',
            'label'   => 'bp_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bp_en',
            'label'   => 'bp_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bd_cn',
            'label'   => 'bd_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bd_en',
            'label'   => 'bd_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bkzj_cn',
            'label'   => 'bkzj_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'bkzj_en',
            'label'   => 'bkzj_en',
            'rules'   => 'trim|max_length[255]'
        ),
		array(
			'field'   => 'fs_cn',
			'label'   => 'fs_cn',
			'rules'   => 'trim|max_length[255]'
		),
		array(
			'field'   => 'fs_en',
			'label'   => 'fs_en',
			'rules'   => 'trim|max_length[255]'
		)
    );

    public function __construct()
    {
        parent::__construct();
    }
}

/* End of file product.php */
/* Location: ./application/models/product.php */