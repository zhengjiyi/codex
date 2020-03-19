<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_type_model extends QD_Model {

    public $table = 'product_type';
    public $primary_key = 'id';

    public $attributes = '';
    public $list_attributes = 'id, type_name, image, type_name_en, ord';
    public $option = array('id', 'type_name');

    public $rules = array(
        array(
            'field'   => 'type_name',
            'label'   => 'type_name',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'type_name_en',
            'label'   => 'type_name_en',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'ord',
            'label'   => 'ord',
            'rules'   => 'trim|max_length[4]'
        )
    );

    public function __construct()
    {
        parent::__construct();
    }
}

/* End of file product_type.php */
/* Location: ./application/models/product_type.php */