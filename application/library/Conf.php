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
			'/product/pclist',
			'/product/pcinfo',
			'/product/modify',
			'/orders/pclist',
			'/orders/handle',
			'/orders/pcinfo'
		);
		$uri = $_SERVER['REQUEST_URI'];
		if(($pos = strpos($uri,"?")) !== false) {
			$uri = substr($uri,0,$pos);
		}
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
	public static function getHelpConf() {
		return array(
			'title' => array (
						array (
								'key' => '系统名',
								'val' => '大风范家具管理后台' 
						),
						array (
								'key' => '负责人',
								'val' => 'QQ:51919790 王坚' 
						),
						array (
								'key' => '功能',
								'val' => '管理家具产品的发布, 订单处理, 账单分析等' 
						),
						array (
								'key' => '流程',
								'val' => '上传产品，浏览产品, 编辑产品, 查看订单, 处理订单' 
						) 
				),
				'content' => array (
						array (
								'key' => '上传产品',
								'val' => '进入上传产品页面, 提交产品明细, 上传后可在产品列表中看到，并可以编辑' 
						),
						array (
								'key' => '订单处理',
								'val' => '进入订单页面, 可见订单分为多组, 每一组可以做相应的处理' 
						),
						array (
								'key' => '热门产品',
								'val' => '热门产品会在app首页显示, 并只显示10个, 设置超过10个热门, 会取最近的10个' 
						),
						array (
								'key' => '财务分析',
								'val' => '当前未做' 
						) 
				),
				'notice' => array (
						array (
								'content' => '产品图片仅限一张, 且大小不能超过10M' 
						),
						array (
								'content' => '下架的产品, 不会再产品列表中显示' 
						),
						array (
								'content' => 'app显示产品详细, 仅显示一张图片' 
						),
						array (
								'content' => '一张订单中, 可有多个产品' 
						) 
				) 
		);
	}
}

?>
