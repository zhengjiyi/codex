<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends QD_Model {

    public $table = 'banner';
    public $primary_key = 'id';

    public $attributes = '';
    public $list_attributes = 'id, img, ord, title_cn1, title_en1, type';

    public $rules = array(
        array(
            'field'   => 'ord',
            'label'   => 'ord',
            'rules'   => 'trim|max_length[4]'
        ),
        array(
            'field'   => 'title_cn1',
            'label'   => 'title_cn1',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'title_en1',
            'label'   => 'title_en1',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'title_cn2',
            'label'   => 'title_cn2',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'title_en2',
            'label'   => 'title_en2',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'url_cn',
            'label'   => 'url_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'url_en',
            'label'   => 'url_en',
            'rules'   => 'trim|max_length[255]'
        )
    );

    public function __construct()
    {
        parent::__construct();
    }
}

/* End of file banner.php */
/* Location: ./application/models/banner.php */