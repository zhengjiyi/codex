<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends QD_Controller {

    public $per_page = 20;

    function __construct()
    {
        parent::__construct();
        $this->data['current'] = '视频管理';
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
        $this->load->model('Video_model', 'video');
        //排序
        $this->video->set_order($this->input->get('order'), 'ord-desc');
        $this->data['list'] = $this->video->list_result($cur_page, $this->per_page);
        $this->data['paging'] = $this->video->paging('video/pages');
        //加载模板
        $this->load->view('video/list', $this->data);
    }

    /**
     * 查看视频管理;
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

            $this->load->model('Video_model', 'video');
            $this->data['video'] = $this->video->get($id);
            $this->load->view('video/view',$this->data);
        }
    }

    /**
     * 添加视频管理;
     * @return  Output a view
     */
    public function add()
    {
        $this->load->model('Video_model', 'video');
        if ($this->video->validate()) {
            //数据
            $data = array(
                'code' => $this->input->post('code'),
                'title' => $this->input->post('title'),
                'img' => $this->resave('img'),
                'ord' => $this->input->post('ord'),
                'addtime' => time()
            );
            //执行
            if ($id = $this->video->insert($data)) {
                //通知
                $this->load->library('notice');
                $this->notice->succeed(array(
                    'title' => '视频管理添加成功！',
                    'location' => '/video/view/'.$id.'?notice=add'
                ));
            }
        } else {
            $this->load->view('video/add',$this->data);
        }
    }

    /**
     * 编辑视频管理;
     * @param   Integer
     * @return  Output a view
     */
    public function edit($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $this->load->model('Video_model', 'video');
            $video = $this->video->get($id);
            if($this->video->validate()){
                //数据
                $data = array(
                    'code' => $this->input->post('code'),
                    'title' => $this->input->post('title'),
                    'img' => $this->resave('img', $video->img),
                    'ord' => $this->input->post('ord'),
                );
                //更新
                if ($this->video->update($id, $data)) {
                    //通知
                    $this->load->library('notice');
                    $this->notice->succeed(array(
                        'title' => '视频管理编辑成功！',
                        'location' => '/video/view/'.$id.'?notice=edit'
                    ));
                }
            } else {
                $this->data['video'] = $video;
                $this->load->view('video/edit', $this->data);
            }
        }
    }
}

/* End of file video.php */
/* Location: ./application/controllers/video.php */