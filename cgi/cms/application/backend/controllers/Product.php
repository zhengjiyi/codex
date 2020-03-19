<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends QD_Controller {

    public $per_page = 20;

    function __construct()
    {
        parent::__construct();
        $this->data['current'] = '产品';
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
        $this->load->model('Product_model', 'product');
        $this->product->set_like('model', $this->input->get('model'));
        $this->product->set_where('product_type', $this->input->get('product_type'));
        //排序
        $this->product->set_order($this->input->get('order'), 'ord desc,id-desc');
        $this->data['list'] = $this->product->list_result($cur_page, $this->per_page);
        $this->data['where'] = $this->product->get_condition();
        $this->data['paging'] = $this->product->paging('product/pages');
        //加载关联数据
        $this->load->model('Product_type_model', 'product_type');
        $this->data['product_type'] = $this->product_type->get_option();
        //加载模板
        $this->load->view('product/list', $this->data);
    }

    /**
     * 查看产品;
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

            $this->load->model('Product_type_model', 'product_type');
            $this->data['product_type'] = $this->product_type->get_option();

            $this->load->model('Tag_model', 'tag');
            $this->data['tag'] = $this->tag->get_option();

            $this->load->model('Product_model', 'product');
			$product = $this->product->get($id);
			$tag = explode(',', $product->tag);
			$tag_str = '';
			foreach( $tag as $id ) {
				if ( !isset($this->data['tag'][$id]) ) continue;
				$tag_str .= $this->data['tag'][$id] . ';';
			}
			$product->tag = $tag_str;

			$product->img = ($product->img) ? explode(',', $product->img) : array();
			$product->ad_img = ($product->ad_img) ? explode(',', $product->ad_img) : array();
            $this->data['product'] = $product;
            $this->load->view('product/view',$this->data);
        }
    }

    /**
     * 添加产品;
     * @return  Output a view
     */
    public function add()
    {
        $this->load->model('Product_model', 'product');
        if ($this->product->validate()) {
        	$tag = $_POST['tag'];
			sort($tag);
            //数据
            $data = array(
                'model' => $this->input->post('model'),
				'ord' => $this->input->post('ord'),
                'product_type' => $this->input->post('product_type'),
                'img' => $this->_save_img('img'),
                'ad_img' => $this->_save_img('ad_img'),
                'buy_link' => $this->input->post('buy_link'),
                'price' => $this->input->post('price'),
                'price_en' => $this->input->post('price_en'),
                'jx_cn' => $this->input->post('jx_cn'),
                'jx_en' => $this->input->post('jx_en'),
                'gn_cn' => $this->input->post('gn_cn'),
                'gn_en' => $this->input->post('gn_en'),
                'bk_cn' => $this->input->post('bk_cn'),
                'bk_en' => $this->input->post('bk_en'),
                'bj_cn' => $this->input->post('bj_cn'),
                'bj_en' => $this->input->post('bj_en'),
                'dg_cn' => $this->input->post('dg_cn'),
                'dg_en' => $this->input->post('dg_en'),
                'bp_cn' => $this->input->post('bp_cn'),
                'bp_en' => $this->input->post('bp_en'),
                'bd_cn' => $this->input->post('bd_cn'),
                'bd_en' => $this->input->post('bd_en'),
                'bkzj_cn' => $this->input->post('bkzj_cn'),
                'bkzj_en' => $this->input->post('bkzj_en'),
				'fs_en' => $this->input->post('fs_en'),
				'fs_cn' => $this->input->post('fs_cn'),
                'tag' => implode(',', $tag),
                'addtime' => time()
            );
            //执行
            if ($id = $this->product->insert($data)) {
                //通知
                $this->load->library('notice');
                $this->notice->succeed(array(
                    'title' => '产品添加成功！',
                    'location' => '/product/view/'.$id.'?notice=add'
                ));
            }
        } else {
            $this->load->model('Product_type_model', 'product_type');
            $this->data['product_type'] = $this->product_type->get_option();
            $this->_init_tag();
            $this->load->view('product/add',$this->data);
        }
    }

    private function _init_tag() {
		$this->load->model('Tag_model', 'tag');
		$tag = $this->tag->get_all();

		$this->load->model('Tag_type_model', 'tag_type');
		$tag_type = $this->tag_type->get_option();

		$tag_result = array();
		foreach( $tag as $v ) {
			if ( !isset( $tag_type[$v->tag_type_id] ) ) continue;
			$key = $tag_type[$v->tag_type_id];
			$tag_result[$key][] = $v;
		}

		$this->data['tag'] = $tag_result;
	}

    /**
     * 编辑产品;
     * @param   Integer
     * @return  Output a view
     */
    public function edit($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $this->load->model('Product_model', 'product');
            $product = $this->product->get($id);
            if($this->product->validate()){
				$tag = $_POST['tag'];
				sort($tag);
                //数据
                $data = array(
                    'model' => $this->input->post('model'),
                    'ord' => $this->input->post('ord'),
                    'product_type' => $this->input->post('product_type'),
                    'img' => $this->_save_img('img', $product->img),
                    'ad_img' => $this->_save_img('ad_img', $product->ad_img),
                    'buy_link' => $this->input->post('buy_link'),
                    'price' => $this->input->post('price'),
                    'price_en' => $this->input->post('price_en'),
                    'jx_cn' => $this->input->post('jx_cn'),
                    'jx_en' => $this->input->post('jx_en'),
                    'gn_cn' => $this->input->post('gn_cn'),
                    'gn_en' => $this->input->post('gn_en'),
                    'bk_cn' => $this->input->post('bk_cn'),
                    'bk_en' => $this->input->post('bk_en'),
                    'bj_cn' => $this->input->post('bj_cn'),
                    'bj_en' => $this->input->post('bj_en'),
                    'dg_cn' => $this->input->post('dg_cn'),
                    'dg_en' => $this->input->post('dg_en'),
                    'bp_cn' => $this->input->post('bp_cn'),
                    'bp_en' => $this->input->post('bp_en'),
                    'bd_cn' => $this->input->post('bd_cn'),
                    'bd_en' => $this->input->post('bd_en'),
                    'bkzj_cn' => $this->input->post('bkzj_cn'),
                    'bkzj_en' => $this->input->post('bkzj_en'),
                    'fs_en' => $this->input->post('fs_en'),
                    'fs_cn' => $this->input->post('fs_cn'),
                    'tag' => implode(',', $tag),
                );
                //更新
                if ($this->product->update($id, $data)) {
                    //通知
                    $this->load->library('notice');
                    $this->notice->succeed(array(
                        'title' => '产品编辑成功！',
                        'location' => '/product/view/'.$id.'?notice=edit'
                    ));
                }
            } else {
				$product->img = ($product->img) ? explode(',', $product->img) : array();
				$product->ad_img = ($product->ad_img) ? explode(',', $product->ad_img) : array();
				$product->tag = explode(',', $product->tag);
                $this->data['product'] = $product;

				$this->load->model('Product_type_model', 'product_type');
				$this->data['product_type'] = $this->product_type->get_option();
				$this->_init_tag();
                $this->load->view('product/edit', $this->data);
            }
        }
    }

	/**
	 * 处理产品多图上传
	 * @param $field
	 * @param null $imgs
	 */
    private function _save_img($field, $imgs=NULL) {
    	if ( !isset($_POST[$field]) ) return '';
    	$new_imgs = $_POST[$field];
    	if ( empty($new_imgs) ) return $imgs;
		$imgs_arr = explode(',', $imgs);
		$imgs_res = array();
    	foreach($new_imgs as $img) {
			if (! empty($img) && !in_array($img, $imgs_arr)) { //新图片
				$this->load->library('storage');
				$this->storage->initialize($this->ctrl, $field); //初始化
				$imgs_res[] = $this->storage->resave($img); //文件另存为
			} elseif (! empty($img) && in_array($img, $imgs_arr)) {
				$imgs_res[] = $img;
			}
		}
		return implode(',', $imgs_res);
	}
}

/* End of file product.php */
/* Location: ./application/controllers/product.php */