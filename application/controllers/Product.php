<?php

/**
 *
 * @author Administrator
 *        
 */
class ProductController extends BaseController {
	const FILE_MAX_SIZE = 10485760;
	static $filterAttr = array (
			'name',
			'type',
			'standard',
			'price',
			'color',
			'model',
			'material',
			'area',
			'series' 
	);
	static $typeAttr = array (
                        'image/gif',
                        'image/png',
                        'image/jpeg',
                        'image/pjpeg',
                        'image/bmp'
        );
	public function homeAction() {
		$this->display ( "page/home.tpl" );
	}
	public function hotAction() {
		$objProduct = new ProductModel ();
		$arr ['list'] = $objProduct->getHotProductList ();
		$arr ['config'] = Conf::getFilterConf ();
		$this->apiResponse ( $arr );
	}
	public function listAction() {
		$arrInput = self::_checkFilter ( $this->requestParams );
		$objProuduct = new ProductModel ();
		$arr ['list'] = $objProuduct->getProductList ( $arrInput ['filter'], $arrInput ['order'], $arrInput ['pn'] );
		$arr ['hasMore'] = count ( $arr ['list'] ) > 10 ? 1 : 0;
		$arr ['list'] = array_slice($arr ['list'], 0, 10);
		$this->apiResponse ( $arr );
	}
	public function pclistAction() {
		$objProuduct = new ProductModel ();
		$arr ['list'] = $objProuduct->getProductList ( [ ], '', intval ( $this->requestParams ['pn'] ), 10 );
		$arr ['total'] = $objProuduct->getProductCount ();
		$this->assign ( 'data', $arr );
		$this->display ( 'page/list.tpl' );
	}
	public function searchAction() {
		$arrInput = self::_checkSearch ( $this->requestParams );
		$objProuduct = new ProductModel ();
		$arr ['list'] = $objProuduct->searchProduct ( $arrInput ['words'], $arrInput ['pn'] );
		$arr ['hasMore'] = count ( $arr ['list'] ) > 10 ? 1 : 0;
		$this->apiResponse ( $arr );
	}
	public function addAction() {
		$objProduct = new ProductModel ();
		$arrInput = self::_checkParam ( $this->requestParams );
		$ret = $objProduct->addProduct ( $arrInput );
		if ($ret) {
			$this->assign ( 'data', array (
					'ret' => true,
					'jumpUrl' => '/product/pclist' 
			) );
			$this->display ( 'page/jump.tpl' );
		} else {
			throw new AppException ( AppExceptionCodes::ADD_PRODUCT_FAILED );
		}
	}
	public function infoAction() {
		if (empty ( $this->requestParams ['pid'] )) {
			throw new AppException ( AppExceptionCodes::INVALID_PID );
		}
		$pid = intval ( $this->requestParams ['pid'] );
		$objProduct = new ProductModel ();
		$pinfo = $objProduct->getProductInfoById ( $pid );
		$this->apiResponse($pinfo);
	}
	public function pcinfoAction() {
		if (empty ( $this->requestParams ['pid'] )) {
			throw new AppException ( AppExceptionCodes::INVALID_PID );
		}
		$pid = intval ( $this->requestParams ['pid'] );
		$objProduct = new ProductModel ();
		$pinfo = $objProduct->getProductInfoById ( $pid );
		if (empty ( $pinfo )) {
			throw new AppException ( AppExceptionCodes::INVALID_PID );
		}
		$keyArr = array(
				'id' => '产品号',
				'name' =>'名称',
				'type' => '类型',
				'standard' => '规格',
				'price' => '价格',
				'sold' => '销量',
				'area' => '产地',
				'color' => '颜色',
				'model' => '型号',
				'material' => '材质',
				'picture' => '图片',
				'series' => '系列',
				'createTime' => '上传时间', 
				'status' => '状态',
				'hot' => '热门'
				);

		foreach($pinfo as $k => &$v) {
			$v = array(
				'name' => $keyArr[$k],
				'val' => $v
			);
		}
		$this->assign ( 'data', $pinfo );
		$this->display ( 'page/info.tpl' );
	}
	public function modifyAction() {
		$arrInput = self::_checkModify ( $this->requestParams );
		$objProduct = new ProductModel ();
		$ret = $objProduct->updateProduct ( $arrInput ['pid'], $arrInput ['fields'] );
		if ($ret) {
			$this->assign ( 'data', array (
					'ret' => true,
					'jumpUrl' => '/product/pcinfo?pid=' . $arrInput ['pid'] 
			) );
			$this->display ( 'page/jump.tpl' );
		} else {
			throw new AppException ( AppExceptionCodes::MODIFY_PRODUCT_FAILED );
		}
	}
	public function helpAction() {
		$this->assign('data', Conf::getHelpConf());
		$this->display('page/help.tpl');
	}
	private function _checkParam($arrInput) {
		foreach ( self::$filterAttr as $attr ) {
			if (empty ( $arrInput [$attr] )) {
				CLogger::warning ( "leak $attr" );
				throw new AppException ( AppExceptionCodes::PARAM_ERROR );
			}
		}
		if (empty ( $_FILES ['upload'] ) || ! is_uploaded_file ( $_FILES ['upload'] ['tmp_name'] ) || $_FILES ['upload'] ['size'] > self::FILE_MAX_SIZE) {
			throw new AppException ( AppExceptionCodes::PICTURE_NOT_EXIST );
		}
		if (empty ( $_FILES ['upload'] ['type'] ) || ! in_array ( $_FILES ['upload'] ['type'], self::$typeAttr )) {
			throw new AppException ( AppExceptionCodes::PIRCTURE_INVALID );
		}
		if (! move_uploaded_file ( $_FILES ['upload'] ['tmp_name'], PIC_PATH . '/' . md5 ( date ( 'Y-m-d-H:i:s' ) ) . '.' . substr ( strrchr ( $_FILES ['upload'] ['name'], '.' ), 1 ) )) {
			throw new AppException ( AppExceptionCodes::PICTURE_NOT_EXIST );
		}
		$arrInput ['picture']['big'] = md5 ( date ( 'Y-m-d-H:i:s' ) ) . '.' . substr ( strrchr ( $_FILES ['upload'] ['name'], '.' ), 1 );
		$arrInput ['picture']['small'] =  Picture::resizeImage($arrInput ['picture'] ['big']);;
		return $arrInput;
	}
	private function _checkFilter($arrInput) {
		$arrFilter = Conf::getFilterConf ();
		foreach ( $arrFilter ['types'] as $k => $v ) {
			if (isset ( $arrInput [$k] )) {
				$arrInput ['filter'] [$k] = $arrInput [$k];
			}
		}
		if ($arrInput ['order'] && ! in_array ( $arrInput ['order'], array_keys ( $arrFilter ['orders'] ) )) {
			throw new AppException ( AppExceptionCodes::PARAM_ERROR );
		}
		$arrInput ['pn'] = empty ( $arrInput ['pn'] ) ? 0 : intval ( $arrInput ['pn'] );
		return $arrInput;
	}
	private function _checkSearch($arrInput) {
		if (empty ( $arrInput ['words'] )) {
			throw new AppException ( AppExceptionCodes::SEARCH_WORDS_NULL );
		}
		$arrInput ['words'] = trim ( $arrInput ['words'] );
		return $arrInput;
	}
	private function _checkModify($arrInput) {
		$arrOutput = array ();
		if (empty ( $arrInput ['id'] )) {
			throw new AppException ( AppExceptionCodes::INVALID_PID );
		}
		self::$filterAttr = array_merge(self::$filterAttr, ['status', 'hot']);
		foreach ( self::$filterAttr as $attr ) {
			if (isset($arrInput [$attr])) {
				$arrOutput ['fields'] [$attr] = $arrInput [$attr];
			}
		}
		if (empty ( $arrOutput ['fields'] )) {
			throw new AppException ( AppExceptionCodes::PARAM_ERROR );
		}
		if (! empty ( $_FILES ['upload'] ) && is_uploaded_file ( $_FILES ['upload'] ['tmp_name'] )) {
			if (empty ( $_FILES ['upload'] ['type'] ) || ! in_array ( $_FILES ['upload'] ['type'], self::$typeAttr )) {
				throw new AppException ( AppExceptionCodes::PIRCTURE_INVALID );
			}
			if (! move_uploaded_file ( $_FILES ['upload'] ['tmp_name'], PIC_PATH . '/' . md5 ( date ( 'Y-m-d-H:i:s' ) ) . '.' . substr ( strrchr ( $_FILES ['upload'] ['name'], '.' ), 1 ) )) {
				throw new AppException ( AppExceptionCodes::PICTURE_NOT_EXIST );
			}
			$arrOutput ['fields'] ['picture'] ['big'] = md5 ( date ( 'Y-m-d-H:i:s' ) ) . '.' . substr ( strrchr ( $_FILES ['upload'] ['name'], '.' ), 1 );
			$arrOutput ['fields'] ['picture'] ['small'] = Picture::resizeImage($arrOutput ['fields'] ['picture'] ['big']);
			$arrOutput ['fields'] ['picture']  = json_encode($arrOutput ['fields'] ['picture']);
		}
		$arrOutput ['pid'] = $arrInput ['id'];
		return $arrOutput;
	}
}

?>
