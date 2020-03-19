<?php
class tagController extends Controller{

	protected $_field_map = array(
		'cn' => array(
			'tag' => 'tag',
			'tag_en' => '',
			'typename' => 'type',
			'typename_en' => '',
		),
		'en' => array(
			'tag' => '',
			'tag_en' => 'tag',
			'typename' => '',
			'typename_en' => 'type',
		),
	);

	public function index() {
		$model = $this->model('tag');
		$tag = $model->all();
		$tagFormat = array();
		$tagType = array();
		foreach( $tag as $v ) {
			$this->_translate($v);
			$tagType[$v['tag_type_id']] = $v['type'];
			if ( isset( $tagFormat[$v['tag_type_id']] ) ) {
				$tagFormat[$v['tag_type_id']][] = array(
					'id' => $v['id'],
					'tag' => $v['tag'],
				);
			} else {
				$tagFormat[$v['tag_type_id']] = array(
					array(
						'id' => $v['id'],
						'tag' => $v['tag'],
					)
				);
			}
		}
		$res = array();
		foreach( $tagType as $id => $type ) {
			$res[] = array(
				'id' => $id,
				'type' => $type,
				'tags' => $tagFormat[$id],
			);
		}
		$this->response($res);
	}

}