<?php
abstract class Controller
{
	protected $load;
	protected $_lang;
	protected $_field_map;

	public function __construct(){
		$this->load = new Load();
		$this->_lang = isset($_SERVER['HTTP_LANG']) ? $_SERVER['HTTP_LANG'] : 'cn';
		if ( !in_array($this->_lang, array('en','cn')) ) $this->_lang = 'cn';
	}

	public function model($model) {
		return $this->load->model($model);
	}

	public function response($data=NULL, $msg='success', $err=0) {
		header("Access-Control-Allow-Origin: *");
		header('Content-type: application/json');
		echo json_encode(array(
			'err' => $err,
			'msg' => $msg,
			'data' => $data,
		));
		exit;
	}

	protected function lang() {
		return $this->_lang;
	}

	protected function _translate(&$v, $type=NULL) {
		if ( $type ) {
			$fieldMap = isset( $this->_field_map[$type] ) ? $this->_field_map[$type] : NULL;
		} else {
			$fieldMap = $this->_field_map;
		}
		if ( empty($fieldMap) ) return;
		$langField = $fieldMap[$this->_lang];
		foreach( $langField as $k => $k1 ) {
			if ( !isset($v[$k]) ) continue;
			if ( $k1 ) {
				$v[$k1] = $v[$k];
				if ( $k1 != $k ) unset($v[$k]);
			}
			if (empty($k1)) unset($v[$k]);
		}
	}
}