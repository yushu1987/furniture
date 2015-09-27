<?php

/**
 *
 * @author Administrator
 *        
 */
class AppExceptionCodes {
	const PARAM_ERROR 			= 1;
	const PICTURE_NOT_EXIST 	= 3;
	const PIRCTURE_INVALID 		= 4;
	const PIRCTURE_TOO_BIG 		= 5;
	const SEARCH_WORDS_NULL		= 6;
	const INVALID_PHONE			= 7;
	const INVALID_PID			= 8;
	const CUSTOM_EXCEPTION		= 10;
	
	const NEW_ORDER_FAILED		= 11;
	const INVALID_ORDERID		= 12;
	const TOKEN_ERROR 			= 100;
	
	const ADD_PRODUCT_FAILED	= 101;
	public static $errMsg = array (
			self::PARAM_ERROR => "参数错误",
			self::PICTURE_NOT_EXIST => "图片没上传",
			self::PIRCTURE_INVALID => "图片不合法",
			self::PIRCTURE_TOO_BIG => "图片太大了" ,
			self::SEARCH_WORDS_NULL => "查询关键字空",
			self::INVALID_PHONE	=> "手机号不合法",
			self::INVALID_PID => "产品号非法",
			self::CUSTOM_EXCEPTION => "通用错误",
			self::NEW_ORDER_FAILED => "下单失败",
			self::INVALID_ORDERID => "订单号非法",
			self::TOKEN_ERROR => "token错误",
			self::ADD_PRODUCT_FAILED => "上传产品错误"
			
	);
}

?>
