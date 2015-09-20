<?php

/**
 *
 * @author Administrator
 *        
 */
class ProductContoller extends BaseContoller {
	const PIC_PATH = '/home/wangjian/furniture/data/';
	public function hotlistAction() {
		try {
			$objProduct = new Product ();
			$ret = $objProduct->getHotProductList ();
			$this->apiResponse ( $ret );
		} catch ( App_Exception $e ) {
			$this->apiResponse ( array (), $e->getErrNo (), $e->getErrStr () );
		}
	}
	public function addAction() {
		try {
			$objProduct = new Product ();
			$arrInput = $_POST;
			self::__checkParam ( $arrInput );
			$objProduct->addProduct ( $arrInput );
			
		} catch ( App_Exception $e ) {
			//goto error tpl
		}
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
		move_uploaded_file ( $_FILES ['upload'] ['tmp_name'], self::PIC_PATH . '/' . $arrInput ['product'] . '/' . date ( 'Y-m-d-H:i:s' ) . '-' . $_FILES ['upload'] ['name'] );
		$arrInput ['srcName'] = date ( 'Y-m-d-H:i:s' ) . '-' . $_FILES ['upload'] ['name'];
		return $arrInput;
	}
}

?>