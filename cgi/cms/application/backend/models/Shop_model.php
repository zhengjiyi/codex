<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends QD_Model {

    public $table = 'shop';
    public $primary_key = 'id';

    public $attributes = '';
    public $list_attributes = 'id, shop_cn, address_cn, province, city, tel, img, country';

    public $rules = array(
        array(
            'field'   => 'shop_cn',
            'label'   => 'shop_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'shop_en',
            'label'   => 'shop_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'address_cn',
            'label'   => 'address_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'address_en',
            'label'   => 'address_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'province',
            'label'   => 'province',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'city',
            'label'   => 'city',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'tel',
            'label'   => 'tel',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'province_en',
            'label'   => 'province_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'city_en',
            'label'   => 'city_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'country',
            'label'   => 'country',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'country_en',
            'label'   => 'country_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'offer_time_en',
            'label'   => 'offer_time_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'offer_time',
            'label'   => 'offer_time',
            'rules'   => 'trim|max_length[255]'
        )
    );

    public function __construct()
    {
        parent::__construct();
    }
}

/* End of file shop.php */
/* Location: ./application/models/shop.php */