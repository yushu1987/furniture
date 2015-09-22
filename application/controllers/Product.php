<?php

/**
 *
 * @author Administrator
 *        
 */
class ProductController extends BaseController {
	public function hotAction() {
		$objProduct = new ProductModel ();
		$arr['list'] = $objProduct->getHotProductList ();
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
	public function addAction() {
		$objProduct = new Product ();
		$arrInput = self::_checkParam ( $this->requestParams );
		$objProduct->addProduct ( $arrInput );
	}
	private function _checkParam($arrInput) {
		$filterAttr = array (
				'name',
				'type',
				'shop',
				'standard',
				'price',
				'color',
				'area',
				'model',
				'material',
				'picture',
				'fabrics',
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
				throw new App_Exception ( App_Exception_Codes::PARAM_ERROR );
			}
		}
		if (empty ( $_FILES ['upload'] ) || ! is_uploaded_file ( $_FILES ['upload'] ['tmp_name'] ) || $_FILES ['filename'] ['size'] > self::FILE_MAX_SIZE) {
			throw new App_Exception ( App_Exception_Codes::PICTURE_NOT_EXIST );
		}
		if (empty ( $_FILES ['file'] ['type'] ) || ! in_array ( $_FILES ['file'] ['type'], $typeAttr )) {
			throw new App_Exception ( App_Exception_Codes::PIRCTURE_INVALID );
		}
		move_uploaded_file ( $_FILES ['upload'] ['tmp_name'], PIC_PATH . '/' . $arrInput ['product'] . '/' . date ( 'Y-m-d-H:i:s' ) . '-' . $_FILES ['upload'] ['name'] );
		$arrInput ['srcName'] = date ( 'Y-m-d-H:i:s' ) . '-' . $_FILES ['upload'] ['name'];
		return $arrInput;
	}
	
	private function _checkFilter($arrInput) {
		$arrInput['filter'] = array();
		$arrInput['order'] = array();
		$arrFilter = Conf::getFilterConf();
		foreach($arrFilter['types'] as $k) {
			if($arrInput[$k]) {
				$arrInput['filter'][$k] = $arrInput[$k];
			}
		}
		foreach($arrInput['orders'] as $k) {
			if($arrInput[$k]) {
				$arrInput['order'][$k] = $arrInput[$k];
			}
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
