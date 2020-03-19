<?php
class bannerController extends Controller{

	protected $_field_map = array(
		'cn' => array(
			'title_cn1' => 'title1',
			'title_cn2' => 'title2',
			'title_en1' => '',
			'title_en2' => '',
			'url_cn' => 'url',
			'url_en' => '',
		),
		'en' => array(
			'title_en1' => 'title1',
			'title_en2' => 'title2',
			'title_cn1' => '',
			'title_cn2' => '',
			'url_cn' => '',
			'url_en' => 'url',
		),
	);

	public function index() {
		$bannerModel = $this->model('banner');
		$banner = $bannerModel->all();
		foreach($banner as $k => $v) {
			$banner[$k]['img'] = config_item('site_url') . $v['img'];
			$banner[$k]['video'] = ($v['video']) ? config_item('site_url') . $v['video'] : '';
			$this->_translate($banner[$k]);
		}
		$this->response($banner);
	}
}