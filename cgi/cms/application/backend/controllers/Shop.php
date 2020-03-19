<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends QD_Controller {

    public $per_page = 20;

    function __construct()
    {
        parent::__construct();
        $this->data['current'] = '门店管理';
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
        $this->load->model('Shop_model', 'shop');
        //排序
        $this->shop->set_order($this->input->get('order'), 'id-desc');
        $this->data['list'] = $this->shop->list_result($cur_page, $this->per_page);
        $this->data['paging'] = $this->shop->paging('shop/pages');
        //加载模板
        $this->load->view('shop/list', $this->data);
    }

    /**
     * 查看门店管理;
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

            $this->load->model('Shop_model', 'shop');
            $this->data['shop'] = $this->shop->get($id);
            $this->load->view('shop/view',$this->data);
        }
    }

    /**
     * 添加门店管理;
     * @return  Output a view
     */
    public function add()
    {
        $this->load->model('Shop_model', 'shop');
        if ($this->shop->validate()) {
            //数据
            $data = array(
                'shop_cn' => $this->input->post('shop_cn'),
                'shop_en' => $this->input->post('shop_en'),
                'address_cn' => $this->input->post('address_cn'),
                'address_en' => $this->input->post('address_en'),
                'province' => $this->input->post('province'),
                'city' => $this->input->post('city'),
                'tel' => $this->input->post('tel'),
                'img' => $this->resave('img'),
                'province_en' => $this->input->post('province_en'),
                'city_en' => $this->input->post('city_en'),
                'country' => $this->input->post('country'),
                'country_en' => $this->input->post('country_en'),
                'offer_time_en' => $this->input->post('offer_time_en'),
                'offer_time' => $this->input->post('offer_time')
            );
            //执行
            if ($id = $this->shop->insert($data)) {
                //通知
                $this->load->library('notice');
                $this->notice->succeed(array(
                    'title' => '门店管理添加成功！',
                    'location' => '/shop/view/'.$id.'?notice=add'
                ));
            }
        } else {
            $this->load->view('shop/add',$this->data);
        }
    }

    /**
     * 编辑门店管理;
     * @param   Integer
     * @return  Output a view
     */
    public function edit($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $this->load->model('Shop_model', 'shop');
            $shop = $this->shop->get($id);
            if($this->shop->validate()){
                //数据
                $data = array(
                    'shop_cn' => $this->input->post('shop_cn'),
                    'shop_en' => $this->input->post('shop_en'),
                    'address_cn' => $this->input->post('address_cn'),
                    'address_en' => $this->input->post('address_en'),
                    'province' => $this->input->post('province'),
                    'city' => $this->input->post('city'),
                    'tel' => $this->input->post('tel'),
                    'img' => $this->resave('img', $shop->img),
                    'province_en' => $this->input->post('province_en'),
                    'city_en' => $this->input->post('city_en'),
                    'country' => $this->input->post('country'),
                    'country_en' => $this->input->post('country_en'),
                    'offer_time_en' => $this->input->post('offer_time_en'),
                    'offer_time' => $this->input->post('offer_time')
                );
                //更新
                if ($this->shop->update($id, $data)) {
                    //通知
                    $this->load->library('notice');
                    $this->notice->succeed(array(
                        'title' => '门店管理编辑成功！',
                        'location' => '/shop/view/'.$id.'?notice=edit'
                    ));
                }
            } else {
                $this->data['shop'] = $shop;
                $this->load->view('shop/edit', $this->data);
            }
        }
    }
}

/* End of file shop.php */
/* Location: ./application/controllers/shop.php */