<?php
class shopController extends Controller{

	protected $_limit = 5;
	protected $_field_map = array(
		'cn' => array(
			'shop_cn' => 'shop',
			'shop_en' => '',
			'address_cn' => 'address',
			'address_en' => '',
			'province' => 'province',
			'province_en' => '',
			'city' => 'city',
			'city_en' => '',
			'country' => 'country',
			'country_en' => '',
			'offer_time' => 'offer_time',
			'offer_time_en' => '',
		),
		'en' => array(
			'shop_cn' => '',
			'shop_en' => 'shop',
			'address_cn' => '',
			'address_en' => 'address',
			'province' => '',
			'province_en' => 'province',
			'city' => '',
			'city_en' => 'city',
			'country' => '',
			'country_en' => 'country',
			'offer_time' => '',
			'offer_time_en' => 'offer_time',
		),
	);

	public function index() {
		$country = get('nation', NULL);
		$city = get('city', NULL);

		$model = $this->model('shop');
		$shop = $model->all(0, 0);
		foreach($shop as $k => $v) {
			$shop[$k]['img'] = config_item('site_url') . $v['img'];
			$this->_translate($shop[$k]);
		}
		$this->_format($shop, $country, $city);
		$this->response($shop);
	}

	/**
	 * 格式化
	 * 1.汇总所有国家
	 * 2.汇总所有城市
	 * 3.按照城市汇总门店
	 * @param $shop
	 */
	private function _format(&$shop, $country=NULL, $city=NULL) {
		$res = array(
			'city' => array(),
			'shop' => array(),
		);
		foreach( $shop as $k => $v ) {
			if ( $country && $v['country'] != $country ) continue;
			if ( $city && $v['city'] != $city ) continue;

			if ( !isset($res['city'][$v['country']]) ) $res['city'][$v['country']] = array();
			if ( !in_array($v['city'], $res['city'][$v['country']]) ) $res['city'][$v['country']][] = $v['city'];
			if ( !isset($res['shop'][$v['city']]) ) $res['shop'][$v['city']] = array('shop'=>array(), 'has_more'=>0);
			if ( $country || $city ) {
				$res['shop'][$v['city']]['shop'][] = $v;
			} else {
				if ( count($res['shop'][$v['city']]['shop']) < $this->_limit ) {
					$res['shop'][$v['city']]['shop'][] = $v;
				} else {
					$res['shop'][$v['city']]['has_more'] = 1;
				}
			}
		}
		$shop = $res;
	}

	public function view() {
		try {
			$id = intval(get('id', 0));
			if (empty($id)) throw new Exception('err', -1);
			$model = $this->model('shop');
			$shop = $model->get_by_pk($id);
			if (empty($shop)) throw new Exception('err', -1);
			$shop['img'] = config_item('site_url') . $shop['img'];
			$this->_translate($shop);
			$this->response($shop);
		} catch (Exception $e) {
			$this->response(NULL, $e->getMessage(), $e->getCode());
		}
	}
}