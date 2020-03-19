<?php
class indexController extends Controller{

	private function _wx() {
		$this->load->helper('wechat');
		$wechat_config = config_item('wechat');
		return new Wechat($wechat_config);
	}

	public function weixin() {
		$url = urldecode(get('url'));	
		$result = $this->_init_response();
		try {
			if ( empty( $url ) ) throw new Exception('请传递url参数', -1);
			$wechat = $this->_wx();
			$result['data'] = $wechat->getJsSign($url);
			if ( empty( $result['data'] ) ) throw new Exception('生成签名失败', -2);
		} catch( Exception $e ) {
			$result['data'] = $e->getMessage();
			$result['err'] = $e->getCode();
		}
		$this->_response($result);
	}

	private function _init_response() {
		return array(
			'err' => 0,
			'msg' => NULL,
			'data' => NULL,
		);
	}

	private function _response($data) {
		header('Content-type: application/json');
		header('Access-Control-Allow-Origin: *');
		exit(json_encode($data));
	}

	public function register() {
		$mobile = get('mobile');
		$status = get('status');
		$status = empty($status) ? 0 : 1;
		$result = $this->_init_response();
		try {
			if ( empty( $mobile ) ) throw new Exception('手机号码为空', -1);
			$pattern = '/^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\\d{8}$/';
			if ( !preg_match($pattern, $mobile) ) throw new Exception("手机格式不正确", -2);

			$user = $this->load->model('user');
			$exists = $user->get_by_mobile($mobile);
			if ( isset( $exists ) ) {
				if ($exists['status']) throw new Exception("已注册过", -3);
				if ( $status ) $user->update_by_mobile($mobile, $status);
			} else {
				$userData = [
					'mobile' => $mobile,
					'status' => $status,
					'addtime' => time(),
				];
				$user->insert($userData);
			}
			$result['data'] = '记录成功';
		} catch( Exception $e ) {
			$result['data'] = $e->getMessage();
			$result['err'] = $e->getCode();
		}
		$this->_response($result);
	}
}