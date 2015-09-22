<?php

/**
 *
 * @author Administrator
 *        
 */
class AppExceptionCodes {
	const PARAM_ERROR 			= 1;
	const ORDER_FAILED 			= 2;
	const PICTURE_NOT_EXIST 	= 3;
	const PIRCTURE_INVALID 		= 4;
	const PIRCTURE_TOO_BIG 		= 5;
	const SEARCH_WORDS_NULL		= 6;
	const CUSTOM_EXCEPTION		= 10;
	const TOKEN_ERROR 			= 100;
	public static $errMsg = array (
			self::PARAM_ERROR => "参数错误",
			self::ORDER_FAILED => "下单失败",
			self::PICTURE_NOT_EXIST => "图片没上传",
			self::PIRCTURE_INVALID => "图片不合法",
			self::PIRCTURE_TOO_BIG => "图片太大了" ,
			self::SEARCH_WORDS_NULL => "查询关键字空",
			self::CUSTOM_EXCEPTION => "通用错误",
			self::TOKEN_ERROR => "token错误"
			
	);
}

?>
