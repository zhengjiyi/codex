<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends QD_Controller {

    public $per_page = 20;

    function __construct()
    {
        parent::__construct();
        $this->data['current'] = 'banner';
        $this->data['items'] = array('edit' => '基本信息');
        $this->data['type'] = array(
        	'1' => '图片',
        	'2' => '视频',
		);
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
        $this->load->model('Banner_model', 'banner');
        //排序
        $this->banner->set_order($this->input->get('order'), 'ord-desc');
        $this->data['list'] = $this->banner->list_result($cur_page, $this->per_page);
        $this->data['paging'] = $this->banner->paging('banner/pages');
        //加载模板
        $this->load->view('banner/list', $this->data);
    }

    /**
     * 查看banner;
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

            $this->load->model('Banner_model', 'banner');
            $this->data['banner'] = $this->banner->get($id);
            $this->load->view('banner/view',$this->data);
        }
    }

    /**
     * 添加banner;
     * @return  Output a view
     */
    public function add()
    {
        $this->load->model('Banner_model', 'banner');
        if ($this->banner->validate()) {
            //数据
            $data = array(
                'img' => $this->resave('img'),
                'ord' => $this->input->post('ord'),
                'title_cn1' => $this->input->post('title_cn1'),
                'title_en1' => $this->input->post('title_en1'),
                'title_cn2' => $this->input->post('title_cn2'),
                'title_en2' => $this->input->post('title_en2'),
                'url_cn' => $this->input->post('url_cn'),
                'addtime' => time(),
                'url_en' => $this->input->post('url_en'),
                'type' => $this->input->post('type'),
                'video' => $this->resave('video')
            );
            //执行
            if ($id = $this->banner->insert($data)) {
                //通知
                $this->load->library('notice');
                $this->notice->succeed(array(
                    'title' => 'banner添加成功！',
                    'location' => '/banner/view/'.$id.'?notice=add'
                ));
            }
        } else {
            $this->load->view('banner/add',$this->data);
        }
    }

    /**
     * 编辑banner;
     * @param   Integer
     * @return  Output a view
     */
    public function edit($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $this->load->model('Banner_model', 'banner');
            $banner = $this->banner->get($id);
            if($this->banner->validate()){
                //数据
                $data = array(
                    'img' => $this->resave('img', $banner->img),
                    'ord' => $this->input->post('ord'),
                    'title_cn1' => $this->input->post('title_cn1'),
                    'title_en1' => $this->input->post('title_en1'),
                    'title_cn2' => $this->input->post('title_cn2'),
                    'title_en2' => $this->input->post('title_en2'),
                    'url_cn' => $this->input->post('url_cn'),
                    'url_en' => $this->input->post('url_en'),
                    'type' => $this->input->post('type'),
                    'video' => $this->resave('video', $banner->video)
                );
                //更新
                if ($this->banner->update($id, $data)) {
                    //通知
                    $this->load->library('notice');
                    $this->notice->succeed(array(
                        'title' => 'banner编辑成功！',
                        'location' => '/banner/view/'.$id.'?notice=edit'
                    ));
                }
            } else {
                $this->data['banner'] = $banner;
                $this->load->view('banner/edit', $this->data);
            }
        }
    }
}

/* End of file banner.php */
/* Location: ./application/controllers/banner.php */