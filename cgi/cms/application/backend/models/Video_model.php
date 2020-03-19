<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video_model extends QD_Model {

    public $table = 'video';
    public $primary_key = 'id';

    public $attributes = '';
    public $list_attributes = 'id, title, ord, addtime';

    public $rules = array(
        array(
            'field'   => 'title',
            'label'   => 'title',
            'rules'   => 'trim|max_length[255]'
        ),
        array(
            'field'   => 'ord',
            'label'   => 'ord',
            'rules'   => 'trim|max_length[6]'
        )
    );

    public function __construct()
    {
        parent::__construct();
    }
}

/* End of file video.php */
/* Location: ./application/models/video.php */