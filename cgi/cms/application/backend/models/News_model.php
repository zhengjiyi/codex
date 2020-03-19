<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends QD_Model {

    public $table = 'news';
    public $primary_key = 'id';

    public $attributes = '';
    public $list_attributes = 'id, img, pub_date, title_cn';

    public $rules = array(
        array(
            'field'   => 'title_cn',
            'label'   => 'title_cn',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'title_en',
            'label'   => 'title_en',
            'rules'   => 'trim|max_length[255]'
        )
    );

    public function __construct()
    {
        parent::__construct();
    }
}

/* End of file news.php */
/* Location: ./application/models/news.php */