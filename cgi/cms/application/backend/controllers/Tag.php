<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends QD_Controller {

    public $per_page = 20;

    function __construct()
    {
        parent::__construct();
        $this->data['current'] = '标签';
        $this->data['items'] = array('edit' => '基本信息');
    }

    /**
     * 首页
     * @return  Output a view
     */
    public function index()
    {
        $this->pages();
    }

    /**
     * 列表页
     * @param   Integer
     * @return  Output a view
     */
    public function pages($cur_page = 0)
    {
        //获取结果集
        $this->load->model('Tag_model', 'tag');
        //排序
        $this->tag->set_order($this->input->get('order'), 'id-desc');
        $this->data['list'] = $this->tag->list_result($cur_page, $this->per_page);
        $this->data['paging'] = $this->tag->paging('tag/pages');
        //加载关联数据
        $this->load->model('Tag_type_model', 'tag_type');
        $this->data['tag_type'] = $this->tag_type->get_option();
        //加载模板
        $this->load->view('tag/list', $this->data);
    }

    /**
     * 查看标签;
     * @param   Integer
     * @return  Output a view
     */
    public function view($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            if ($this->input->get('notice')) {
                $this->load->library('notice');
                if ($notice = $this->notice->getNotice()) {
                    $this->data['notice'] = $notice;
                }
            }

            $this->load->model('Tag_type_model', 'tag_type');
            $this->data['tag_type'] = $this->tag_type->get_option();

            $this->load->model('Tag_model', 'tag');
            $this->data['tag'] = $this->tag->get($id);
            $this->load->view('tag/view',$this->data);
        }
    }

    /**
     * 添加标签;
     * @return  Output a view
     */
    public function add()
    {
        $this->load->model('Tag_model', 'tag');
        if ($this->tag->validate()) {
            //数据
            $data = array(
                'tag' => $this->input->post('tag'),
                'tag_type_id' => $this->input->post('tag_type_id'),
                'tag_en' => $this->input->post('tag_en')
            );
            //执行
            if ($id = $this->tag->insert($data)) {
                //通知
                $this->load->library('notice');
                $this->notice->succeed(array(
                    'title' => '标签添加成功！',
                    'location' => '/tag/view/'.$id.'?notice=add'
                ));
            }
        } else {
            $this->load->model('Tag_type_model', 'tag_type');
            $this->data['tag_type'] = $this->tag_type->get_option();
            $this->load->view('tag/add',$this->data);
        }
    }

    /**
     * 编辑标签;
     * @param   Integer
     * @return  Output a view
     */
    public function edit($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $this->load->model('Tag_model', 'tag');
            if($this->tag->validate()){
                //数据
                $data = array(
                    'tag' => $this->input->post('tag'),
                    'tag_type_id' => $this->input->post('tag_type_id'),
                    'tag_en' => $this->input->post('tag_en')
                );
                //更新
                if ($this->tag->update($id, $data)) {
                    //通知
                    $this->load->library('notice');
                    $this->notice->succeed(array(
                        'title' => '标签编辑成功！',
                        'location' => '/tag/view/'.$id.'?notice=edit'
                    ));
                }
            } else {
                $this->data['tag'] = $this->tag->get($id);

                $this->load->model('Tag_type_model', 'tag_type');
                $this->data['tag_type'] = $this->tag_type->get_option();
                $this->load->view('tag/edit', $this->data);
            }
        }
    }
}

/* End of file tag.php */
/* Location: ./application/controllers/tag.php */