<?php

/**
 *
 * @author Administrator
 *        
 */
class Conf {
	public static $config;
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
		$arr = self::$config->filter->config->toArray();
		$arr['types'] = explode(',',$arr['types']);
		$arr['orders'] = explode(',', $arr['orders']);
		return $arr;
	}
}

?>
