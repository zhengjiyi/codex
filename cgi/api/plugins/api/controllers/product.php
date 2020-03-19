<?php
class productController extends Controller{

	private $_tag = array();
	protected $_field_map = array(
		'type' => array(
			'cn' => array(
				'type_name' => 'type_name',
				'type_name_en' => '',
			),
			'en' => array(
				'type_name' => '',
				'type_name_en' => 'type_name',
			),
		),
		'product' => array(
			'cn' => array(
				'type' => 'type',
				'type_en' => '',
				'jx_cn' => 'jx',
				'jx_en' => '',
				'gn_cn' => 'gn',
				'gn_en' => '',
				'bk_cn' => 'bk',
				'bk_en' => '',
				'bj_cn' => 'bj',
				'bj_en' => '',
				'dg_cn' => 'dg',
				'dg_en' => '',
				'bp_cn' => 'bp',
				'bp_en' => '',
				'bd_cn' => 'bd',
				'bd_en' => '',
				'bkzj_cn' => 'bkzj',
				'bkzj_en' => '',
				'price' => 'price',
				'price_en' => '',
				'fs_cn' => 'fs',
				'fs_en' => '',
			),
			'en' => array(
				'type' => '',
				'type_en' => 'type',
				'jx_cn' => '',
				'jx_en' => 'jx',
				'gn_cn' => '',
				'gn_en' => 'gn',
				'bk_cn' => '',
				'bk_en' => 'bk',
				'bj_cn' => '',
				'bj_en' => 'bj',
				'dg_cn' => '',
				'dg_en' => 'dg',
				'bp_cn' => '',
				'bp_en' => 'bp',
				'bd_cn' => '',
				'bd_en' => 'bd',
				'bkzj_cn' => '',
				'bkzj_en' => 'bkzj',
				'price' => '',
				'price_en' => 'price',
				'fs_cn' => '',
				'fs_en' => 'fs',
			),
		),
		'tag' => array(
			'cn' => array(
				'tag' => 'tag',
				'tag_en' => '',
			),
			'en' => array(
				'tag' => '',
				'tag_en' => 'tag',
			),
		),
		'news' => array(
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
		)
	);

	function __construct()
	{
		parent::__construct();
		$tagModel = $this->model('tag');
		$tagData = $tagModel->all();
		foreach ($tagData as $k => $v) {
			$this->_translate($v, 'tag');
			$this->_tag[$v['id']] = $v;
		}
	}

	private function _filter_tag() {
		$tags = explode(',', get('tag', NULL));
		foreach( $tags as $k => $v ) {
			$tags[$k] = intval($v);
			if ( empty($tags[$k]) ) unset($tags[$k]);
		}
		sort($tags);
		return $tags;
	}

	public function index() {
		$page = intval(get('p', 1));
		$limit = intval(get('limit', 12));
		$typeid = intval(get('typeid', 0));
		$tag = $this->_filter_tag();


		$productModel = $this->model('product');
		$total = $productModel->total($typeid, $tag);
		$product = $productModel->all($limit, ($page-1)*$limit, $typeid, $tag);
		foreach($product as $k => $v) {
			$product[$k] = $this->_format($v);
			$this->_translate($product[$k], 'product');
		}
 		$this->response(array(
			'total' => $total,
			'data' => $product,
		));
	}

	private function _format($product) {
		$imgs = explode(',', $product['img']);
		$img_arr = array();
		foreach($imgs as $img) {
			if ( empty($img) ) continue;
			$img_arr[] = config_item('site_url') . $img;
		}
		$product['img'] = $img_arr;

		$imgs = explode(',', $product['ad_img']);
		$img_arr = array();
		foreach($imgs as $img) {
			if ( empty($img) ) continue;
			$img_arr[] = config_item('site_url') . $img;
		}
		$product['ad_img'] = $img_arr;

		$product['tag'] = $this->_getTag($product['tag']);
		return $product;
	}

	private function _getTag($tagids) {
		$tags = explode(',', $tagids);
		$tagData = array();
		foreach( $tags as $id ) {
			if ( !isset($this->_tag[$id]) ) continue;
			$tagData[] = array(
				'id' => $id,
				'tag' => $this->_tag[$id]['tag'],
			);
		}
		return $tagData;
	}

	public function type() {
		$model = $this->model('product_type');
		$type = $model->all();
		foreach($type as $k => $v) {
			$type[$k]['image'] = config_item('site_url') . $v['image'];
			$this->_translate($type[$k], 'type');
		}
		$this->response($type);
	}

	public function view() {
		try {
			$id = intval(get('id', 0));
			if ( empty($id) ) throw new Exception('err', -1);
			$productModel = $this->model('product');
			$product = $productModel->get_by_pk($id);
			if ( empty( $product ) ) throw new Exception('err', -1);
			$product = $this->_format($product);
			$this->_translate($product, 'product');
			$res = array(
				'product' => $product,
				'recommend' => $this->_recommend($product),
				'next_id' => $productModel->get_next_id($id),
				'prev_id' => $productModel->get_prev_id($id),
			);
			$this->response($res);
		} catch (Exception $e) {
			$this->response(NULL, $e->getMessage(), $e->getCode());
		}
	}

	private function _recommend($prodcut) {
		$typeid = $prodcut['product_type'];
		$model = $this->model('product');
		$product = $model->recommend($prodcut['id'], $typeid, 3);
		foreach( $product as $k => $v ) {
			unset($product[$k]['buy_link']);
			unset($product[$k]['price']);
			$product[$k] = $this->_format($v);
			$this->_translate($product[$k], 'product');
		}
		return $product;
	}

	public function search() {
		$keyword = get('keyword');
		$res = array(
			'product' => array(),
			'news' => array(),
		);
		try {
			if ( empty($keyword) ) throw new Exception('关键字为空', -1);
			$newsModel = $this->model('news');
			$productModel = $this->model('product');
			$news = $newsModel->all(0, 0, $keyword, $this->_lang);
			$product = $productModel->all(0, 0, NULL, NULL, $keyword, $this->_lang);
			foreach( $product as $k => $v ) {
				$product[$k] = $this->_format($v);
				$this->_translate($product[$k], 'product');
			}
			foreach($news as $k => $v) {
				$news[$k]['img'] = config_item('site_url') . $v['img'];
				$this->_translate($news[$k], 'news');
			}

			$res = array(
				'product' => $product,
				'news' => $news,
			);
		} catch (Exception $e) {

		}
		$this->response($res);
	}

}
