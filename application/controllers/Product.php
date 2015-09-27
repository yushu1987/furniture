<?php

/**
 *
 * @author Administrator
 *        
 */
class ProductController extends BaseController {
	public function homeAction() {
		$this->display("page/home.tpl");
		return FALSE;
	}
	public function hotAction() {
		$objProduct = new ProductModel ();
		$arr['list'] = $objProduct->getHotProductList ();
		$arr['config'] = Conf::getFilterConf();
		$this->apiResponse ( $arr);
	}
	public function listAction() {
		$arrInput = self::_checkFilter($this->requestParams);
		$objProuduct = new ProductModel();
		$arr['list'] = $objProuduct->getProductList($arrInput['filter'], $arrInput['order'], $arrInput['pn']);
		$arr['hasMore']  = count($arr['list']) > 10 ? 1: 0;
		$this->apiResponse($arr);
	}
	public function searchAction() {
		$arrInput = self::_checkSearch($this->requestParams);
		$objProuduct = new ProductModel();
		$arr['list'] = $objProuduct->searchProduct($arrInput['words'], $arrInput['pn']);
		$arr['hasMore']  = count($arr['list']) > 10 ? 1: 0;
		$this->apiResponse($arr);
	}
	public function pcAddAction() {
		$objProduct = new ProductModel ();
		$arrInput = self::_checkParam ( $this->requestParams );
		$ret=$objProduct->addProduct ( $arrInput );
		if($ret) {
			$this->assign('data', array('ret' => true, 'jumpUrl'=> '/product/pclist') );
			$this->display('page/list');
		}else {
			throw new AppException(AppExceptionCodes::ADD_PRODUCT_FAILED);
		}
	}
	private function _checkParam($arrInput) {
		$filterAttr = array (
				'name',
				'type',
				'standard',
				'price',
				'color',
				'area',
				'model',
				'material',
				'picture',
				'series',
		);
		$typeAttr = array (
				'image/gif',
				'image/png',
				'image/jpeg',
				'image/pjpeg',
				'image/bmp' 
		);
		foreach ( $filterAttr as $attr ) {
			if (empty ( $arrInput [$attr] )) {
				throw new AppException ( AppExceptionCodes::PARAM_ERROR );
			}
		}
		if (empty ( $_FILES ['upload'] ) || ! is_uploaded_file ( $_FILES ['upload'] ['tmp_name'] ) || $_FILES ['filename'] ['size'] > self::FILE_MAX_SIZE) {
			throw new AppException ( AppExceptionCodes::PICTURE_NOT_EXIST );
		}
		if (empty ( $_FILES ['file'] ['type'] ) || ! in_array ( $_FILES ['file'] ['type'], $typeAttr )) {
			throw new AppException ( AppExceptionCodes::PIRCTURE_INVALID );
		}
		move_uploaded_file ( $_FILES ['upload'] ['tmp_name'], PIC_PATH . '/' . $arrInput ['product'] . '/' . date ( 'Y-m-d-H:i:s' ) . '-' . $_FILES ['upload'] ['name'] );
		$arrInput ['picture'] = date ( 'Y-m-d-H:i:s' ) . '-' . $_FILES ['upload'] ['name'];
		return $arrInput;
	}
	
	private function _checkFilter($arrInput) {
		$arrFilter = Conf::getFilterConf();
		foreach($arrFilter['types'] as $k => $v) {
			if(isset($arrInput[$k])) {
				$arrInput['filter'][$k] = $arrInput[$k];
			}
		}
		if($arrInput['order'] && !in_array($arrInput['order'] ,array_keys($arrFilter['orders']))) {
			throw new AppException(AppExceptionCodes::PARAM_ERROR);
		}
		$arrInput['pn'] = empty($arrInput['pn']) ? 0: intval($arrInput['pn']);
		return $arrInput;
	}
	
	private function _checkSearch($arrInput) {
		if(empty($arrInput['words'])) {
			throw new AppException(AppExceptionCodes::SEARCH_WORDS_NULL);
		}
		$arrInput['words'] = trim($arrInput['words']);
		return $arrInput;
	}
}

?>
