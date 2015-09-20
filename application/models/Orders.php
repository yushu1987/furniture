<?php

/**
 * @name Orders
 * @desc Orders数据获取类, 可以访问数据库，文件，其它系统等
 * @author wangjian
 */
class Orders extends Base {
	const TABLE = 'orders';
	public static $arrFields = array (
			'id',
			'customer',
			'pid',
			'amount',
			'phone',
			'createTime',
			'status' 
	);
	public function getOrderInfoById($orderId) {
		if (empty ( $this->_db )) {
			$this->_db = self::getDB ( self::DATABASE );
		}
		$arrConds = self::getConds ( [ 
				'id' => $orderId 
		] );
		$ret = $this->_db->select ( self::TABLE, self::$arrFields, $arrConds, null, null );
		return count ( $ret ) > 0 ? $ret : array ();
	}
	public function addProduct($arrInput) {
		$arrFields = array (
				'customer' => trim ( $arrInput ['customer'] ),
				'pid' => intval ( $arrInput ['pid'] ),
				'amount' => trim ( $arrInput ['amount'] ),
				'phone' => trim ( $arrInput ['phone'] ),
				'createTime' => time (),
				'status' => 0 
		);
		if (empty ( $this->_db )) {
			$this->_db = self::getDB ( self::DATABASE );
		}
		return $this->_db->insert ( self::TABLE, $arrFields, null, null );
	}
}

?>