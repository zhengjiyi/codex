<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends QD_Controller {

    public $per_page = 20;

    function __construct()
    {
        parent::__construct();
        $this->data['current'] = '新闻动态';
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
        $this->load->model('News_model', 'news');
        //排序
        $this->news->set_order($this->input->get('order'), 'id-desc');
        $this->data['list'] = $this->news->list_result($cur_page, $this->per_page);
        $this->data['paging'] = $this->news->paging('news/pages');
        //加载模板
        $this->load->view('news/list', $this->data);
    }

    /**
     * 查看新闻动态;
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

            $this->load->model('News_model', 'news');
            $this->data['news'] = $this->news->get($id);
            $this->load->view('news/view',$this->data);
        }
    }

    /**
     * 添加新闻动态;
     * @return  Output a view
     */
    public function add()
    {
        $this->load->model('News_model', 'news');
        if ($this->news->validate()) {
            //数据
            $data = array(
                'img' => $this->resave('img'),
                'addtime' => time(),
                'pub_date' => $this->input->post('pub_date'),
                'title_cn' => $this->input->post('title_cn'),
                'content_cn' => $this->input->post('content_cn'),
                'title_en' => $this->input->post('title_en'),
                'content_en' => $this->input->post('content_en')
            );
            //执行
            if ($id = $this->news->insert($data)) {
                //通知
                $this->load->library('notice');
                $this->notice->succeed(array(
                    'title' => '新闻动态添加成功！',
                    'location' => '/news/view/'.$id.'?notice=add'
                ));
            }
        } else {
            $this->load->view('news/add',$this->data);
        }
    }

    /**
     * 编辑新闻动态;
     * @param   Integer
     * @return  Output a view
     */
    public function edit($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $this->load->model('News_model', 'news');
            $news = $this->news->get($id);
            if($this->news->validate()){
                //数据
                $data = array(
                    'img' => $this->resave('img', $news->img),
                    'pub_date' => $this->input->post('pub_date'),
                    'title_cn' => $this->input->post('title_cn'),
                    'content_cn' => $this->input->post('content_cn'),
                    'title_en' => $this->input->post('title_en'),
                    'content_en' => $this->input->post('content_en')
                );
                //更新
                if ($this->news->update($id, $data)) {
                    //通知
                    $this->load->library('notice');
                    $this->notice->succeed(array(
                        'title' => '新闻动态编辑成功！',
                        'location' => '/news/view/'.$id.'?notice=edit'
                    ));
                }
            } else {
                $this->data['news'] = $news;
                $this->load->view('news/edit', $this->data);
            }
        }
    }

    public function upload_img() {
		$this->upload('imgFile', TRUE);
	}
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */