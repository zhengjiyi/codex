<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_type extends QD_Controller {

    public $per_page = 20;

    function __construct()
    {
        parent::__construct();
        $this->data['current'] = '产品系列';
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
        $this->load->model('Product_type_model', 'product_type');
        //排序
        $this->product_type->set_order($this->input->get('order'), 'ord desc,id-desc');
        $this->data['list'] = $this->product_type->list_result($cur_page, $this->per_page);
        $this->data['paging'] = $this->product_type->paging('product_type/pages');
        //加载模板
        $this->load->view('product_type/list', $this->data);
    }

    /**
     * 查看产品系列;
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

            $this->load->model('Product_type_model', 'product_type');
            $this->data['product_type'] = $this->product_type->get($id);
            $this->load->view('product_type/view',$this->data);
        }
    }

    /**
     * 添加产品系列;
     * @return  Output a view
     */
    public function add()
    {
        $this->load->model('Product_type_model', 'product_type');
        if ($this->product_type->validate()) {
            //数据
            $data = array(
                'type_name' => $this->input->post('type_name'),
                'image' => $this->resave('image'),
                'type_name_en' => $this->input->post('type_name_en'),
                'ord' => $this->input->post('ord')
            );
            //执行
            if ($id = $this->product_type->insert($data)) {
                //通知
                $this->load->library('notice');
                $this->notice->succeed(array(
                    'title' => '产品系列添加成功！',
                    'location' => '/product_type/view/'.$id.'?notice=add'
                ));
            }
        } else {
            $this->load->view('product_type/add',$this->data);
        }
    }

    /**
     * 编辑产品系列;
     * @param   Integer
     * @return  Output a view
     */
    public function edit($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $this->load->model('Product_type_model', 'product_type');
            $product_type = $this->product_type->get($id);
            if($this->product_type->validate()){
                //数据
                $data = array(
                    'type_name' => $this->input->post('type_name'),
                    'image' => $this->resave('image', $product_type->image),
                    'type_name_en' => $this->input->post('type_name_en'),
                    'ord' => $this->input->post('ord')
                );
                //更新
                if ($this->product_type->update($id, $data)) {
                    //通知
                    $this->load->library('notice');
                    $this->notice->succeed(array(
                        'title' => '产品系列编辑成功！',
                        'location' => '/product_type/view/'.$id.'?notice=edit'
                    ));
                }
            } else {
                $this->data['product_type'] = $product_type;
                $this->load->view('product_type/edit', $this->data);
            }
        }
    }
}

/* End of file product_type.php */
/* Location: ./application/controllers/product_type.php */