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
		$objProuduct = new ProductModel();
		$arr['list'] = $objProuduct->getProductList();
		$arr['hasMore']  = count($arr['list']) > 10 ? 1: 0;
		$this->apiResponse($arr);
	}
	public function addAction() {
		$objProduct = new Product ();
		$arrInput = self::__checkParam ( $this->requestParams );
		$objProduct->addProduct ( $arrInput );
	}
	private function __checkParam($arrInput) {
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
}

?>
