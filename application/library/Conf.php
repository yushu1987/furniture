<?php

/**
 *
 * @author Administrator
 *        
 */
class Conf {
	public static $config;
	public static function isPcUrl() {
		$pcUrls = array(
			'/product/home',
			'/product/add',
			'/product/all',
			'/product/update',
		);
		$uri = $_SERVER['PHP_SELF'];
		return in_array($uri, $pcUrls);
	}
	public static function getDBConf() {
		self::$config = Yaf_Application::app()->getConfig();
		return self::$config->database->config->toArray(); 
	}
	public static function getLogConf() {
		self::$config = Yaf_Application::app()->getConfig();
		return self::$config->log->config->toArray();
	}
	public static function getFilterConf() {
		self::$config = Yaf_Application::app()->getConfig();
		$arr = self::$config->filters->config->toArray();
		$types_key = explode(',',$arr['types_key']);
		$types_val = explode(',',$arr['types_val']);
		$orders_key = explode(',', $arr['orders_key']);
		$orders_val = explode(',', $arr['orders_val']);
		foreach($types_key as $k ) {
			$arr['types'][$k] = $types_val[$i++];
		}
		foreach($orders_key as $k) {
			$arr['orders'][$k] = $orders_val[$j++];
		}
		return $arr;
	}
}

?>
