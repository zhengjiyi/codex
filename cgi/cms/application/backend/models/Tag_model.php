<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag_model extends QD_Model {

    public $table = 'tag';
    public $primary_key = 'id';

    public $attributes = '';
    public $list_attributes = 'id, tag, tag_type_id, tag_en';
    public $option = array('id', 'tag');

    public $rules = array(
        array(
            'field'   => 'tag',
            'label'   => 'tag',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'tag_en',
            'label'   => 'tag_en',
            'rules'   => 'trim|max_length[255]'
        )
    );

    public function __construct()
    {
        parent::__construct();
    }
}

/* End of file tag.php */
/* Location: ./application/models/tag.php */