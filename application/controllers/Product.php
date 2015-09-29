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
			'series' 
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
		if (empty ( $pinfo )) {
			throw new AppException ( AppExceptionCodes::INVALID_PID );
		}
		$this->assign ( 'data', $pinfo );
		$this->display ( 'page/detail.tpl' );
	}
	public function modifyAction() {
		$arrInput = self::_checkModify ( $this->requestParams );
		$objProduct = new ProductModel ();
		$ret = $objProduct->updateProduct ( $arrInput ['pid'], $arrInput ['fields'] );
		if ($ret) {
			$this->assign ( 'data', array (
					'ret' => true,
					'jumpUrl' => '/product/info?pid=' . $arrInput ['pid'] 
			) );
			$this->display ( 'page/jump.tpl' );
		} else {
			throw new AppException ( AppExceptionCodes::MODIFY_PRODUCT_FAILED );
		}
	}
	private function _checkParam($arrInput) {
		$typeAttr = array (
				'image/gif',
				'image/png',
				'image/jpeg',
				'image/pjpeg',
				'image/bmp' 
		);
		foreach ( self::$filterAttr as $attr ) {
			if (empty ( $arrInput [$attr] )) {
				CLogger::warning ( "leak $attr" );
				throw new AppException ( AppExceptionCodes::PARAM_ERROR );
			}
		}
		if (empty ( $_FILES ['upload'] ) || ! is_uploaded_file ( $_FILES ['upload'] ['tmp_name'] ) || $_FILES ['filename'] ['size'] > self::FILE_MAX_SIZE) {
			throw new AppException ( AppExceptionCodes::PICTURE_NOT_EXIST );
		}
		if (empty ( $_FILES ['upload'] ['type'] ) || ! in_array ( $_FILES ['upload'] ['type'], $typeAttr )) {
			throw new AppException ( AppExceptionCodes::PIRCTURE_INVALID );
		}
		if (! move_uploaded_file ( $_FILES ['upload'] ['tmp_name'], 
				PIC_PATH . '/' . md5 ( date ( 'Y-m-d-H:i:s' ) ) . '.' . 
				substr ( strrchr ( $_FILES ['upload'] ['tmp_name'], '.' ), 1 ) )) {
			throw new AppException ( AppExceptionCodes::PICTURE_NOT_EXIST );
		}
		$arrInput ['picture'] = md5 ( date ( 'Y-m-d-H:i:s' ) ) . '.' .
				substr ( strrchr ( $_FILES ['upload'] ['tmp_name'], '.' ), 1 );
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
		if (empty ( $arrInput ['pid'] )) {
			throw new AppException ( AppExceptionCodes::INVALID_PID );
		}
		foreach ( self::$filterAttr as $attr ) {
			if ($arrInput [$attr]) {
				$arrOutput ['fields'] [$attr] = $arrInput [$attr];
			}
		}
		if (empty ( $arrOutput ['fields'] )) {
			throw new AppException ( AppExceptionCodes::PARAM_ERROR );
		}
		if (! empty ( $_FILES ['upload'] ) && is_uploaded_file ( $_FILES ['upload'] ['tmp_name'] )) {
			if (empty ( $_FILES ['upload'] ['type'] ) || ! in_array ( $_FILES ['upload'] ['type'], $typeAttr )) {
				throw new AppException ( AppExceptionCodes::PIRCTURE_INVALID );
			}
			if (! move_uploaded_file ( $_FILES ['upload'] ['tmp_name'], 
					PIC_PATH . '/' . md5 ( date ( 'Y-m-d-H:i:s' ) ) . '.' . 
					substr ( strrchr ( $_FILES ['upload'] ['tmp_name'], '.' ), 1 ) )) {
				throw new AppException ( AppExceptionCodes::PICTURE_NOT_EXIST );
			}
			$arrOutput ['fields']['picture'] = md5 ( date ( 'Y-m-d-H:i:s' ) ) . '.' . 
									substr ( strrchr ( $_FILES ['upload'] ['tmp_name'], '.' ), 1 );
		}
		$arrOutput ['pid'] = $arrInput ['pid'];
		return $arrOutput;
	}
}

?>
