<?php
class newsController extends Controller{


	protected $_field_map = array(
		'cn' => array(
			'title_en' => '',
			'title_cn' => 'title',
			'content_cn' => 'content',
			'content_en' => '',
		),
		'en' => array(
			'title_en' => 'title',
			'title_cn' => '',
			'content_cn' => '',
			'content_en' => 'content',
		),
	);
	public function index() {
		$page = intval(get('p', 1));
		$limit = intval(get('limit', 3));

		$model = $this->model('news');
		$total = $model->total();
		$news = $model->all($limit, ($page-1)*$limit);
		foreach($news as $k => $v) {
			$news[$k]['img'] = config_item('site_url') . $v['img'];
			$this->_translate($news[$k]);
		}

		$res = array(
			'total' => $total,
			'data' => $news,
		);
		$this->response($res);
	}

	public function view() {
		try {
			$id = intval(get('id', 0));
			if (empty($id)) throw new Exception('err', -1);
			$model = $this->model('news');
			$news = $model->get_by_pk($id);
			if (empty($news)) throw new Exception('err', -1);
			$news['img'] = config_item('site_url') . $news['img'];
			$this->_translate($news);
			$res = array(
				'news' => $news,
				'next_id' => $model->get_next_id($id),
				'prev_id' => $model->get_prev_id($id),
			);
			$this->response($res);
		} catch (Exception $e) {
			$this->response(NULL, $e->getMessage(), $e->getCode());
		}
	}
}