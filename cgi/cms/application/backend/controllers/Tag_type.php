<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag_type extends QD_Controller {

    public $per_page = 20;

    function __construct()
    {
        parent::__construct();
        $this->data['current'] = '标签类型';
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
        $this->load->model('Tag_type_model', 'tag_type');
        //排序
        $this->tag_type->set_order($this->input->get('order'), 'ord desc,id-desc');
        $this->data['list'] = $this->tag_type->list_result($cur_page, $this->per_page);
        $this->data['paging'] = $this->tag_type->paging('tag_type/pages');
        //加载模板
        $this->load->view('tag_type/list', $this->data);
    }

    /**
     * 查看标签类型;
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
            $this->data['tag_type'] = $this->tag_type->get($id);
            $this->load->view('tag_type/view',$this->data);
        }
    }

    /**
     * 添加标签类型;
     * @return  Output a view
     */
    public function add()
    {
        $this->load->model('Tag_type_model', 'tag_type');
        if ($this->tag_type->validate()) {
            //数据
            $data = array(
                'typename' => $this->input->post('typename'),
                'typename_en' => $this->input->post('typename_en'),
                'ord' => $this->input->post('ord')
            );
            //执行
            if ($id = $this->tag_type->insert($data)) {
                //通知
                $this->load->library('notice');
                $this->notice->succeed(array(
                    'title' => '标签类型添加成功！',
                    'location' => '/tag_type/view/'.$id.'?notice=add'
                ));
            }
        } else {
            $this->load->view('tag_type/add',$this->data);
        }
    }

    /**
     * 编辑标签类型;
     * @param   Integer
     * @return  Output a view
     */
    public function edit($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $this->load->model('Tag_type_model', 'tag_type');
            if($this->tag_type->validate()){
                //数据
                $data = array(
                    'typename' => $this->input->post('typename'),
                    'typename_en' => $this->input->post('typename_en'),
                    'ord' => $this->input->post('ord')
                );
                //更新
                if ($this->tag_type->update($id, $data)) {
                    //通知
                    $this->load->library('notice');
                    $this->notice->succeed(array(
                        'title' => '标签类型编辑成功！',
                        'location' => '/tag_type/view/'.$id.'?notice=edit'
                    ));
                }
            } else {
                $this->data['tag_type'] = $this->tag_type->get($id);
                $this->load->view('tag_type/edit', $this->data);
            }
        }
    }
}

/* End of file tag_type.php */
/* Location: ./application/controllers/tag_type.php */