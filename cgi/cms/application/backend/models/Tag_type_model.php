<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag_type_model extends QD_Model {

    public $table = 'tag_type';
    public $primary_key = 'id';

    public $attributes = '';
    public $list_attributes = 'id, typename, typename_en, ord';
    public $option = array('id', 'typename');

    public $rules = array(
        array(
            'field'   => 'typename',
            'label'   => 'typename',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'typename_en',
            'label'   => 'typename_en',
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

/* End of file tag_type.php */
/* Location: ./application/models/tag_type.php */