<?php

/**
 * @name Orders
 * @desc Orders数据获取类, 可以访问数据库，文件，其它系统等
 * @author wangjian
 */
class OrdersModel extends Dao_BaseModel {
	const TABLE = 'orders';
	const NEW_STATUS = 0;
	const CANCEL_STATUS = 1;
	const DONE_STATUS = 2;
	const PEDING_STATUS = 3;
	public static $arrFields = array (
			'id',
			'uname',
			'pids',
			'address',
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
		return count ( $ret ) > 0 ? $ret[0] : array ();
	}
	public function addOrder($arrInput) {
		$arrFields = array (
				'uname' => trim ( $arrInput ['uname'] ),
				'pids' => implode (',' ,$arrInput ['pids'] ),
				'amount' => intval ( $arrInput ['amount'] ),
				'address' => trim ( $arrInput ['address'] ),
				'phone' => trim ( $arrInput ['phone'] ),
				'createTime' => time (),
				'status' => self::NEW_STATUS 
		);
		if (empty ( $this->_db )) {
			$this->_db = self::getDB ( self::DATABASE );
		}
		$ret = $this->_db->insert ( self::TABLE, $arrFields, null, null );
		return $ret ? $this->_db->getInsertID(): 0;
	}
	public function doneOrder($orderId) {
		$arrFields=['status' => self::DONE_STATUS];
		return $this->updateOrders($orderId, $arrFields);
	}
	public function cancelOrder($orderId) {
		$arrFields=['status' => self::CANCEL_STATUS];
		return $this->updateOrders($orderId, $arrFields);
	}
	public function pendingOrder($orderId) {
		$arrFields=['status' => self::PEDING_STATUS];
		return $this->updateOrders($orderId, $arrFields);
	}
	public function updateOrders($orderId, $arrFields) {
		$arrConds = self::getConds ( [ 
				'id' => $orderId 
		] );
		if (empty ( $this->_db )) {
			$this->_db = self::getDB ( self::DATABASE );
		}
		return $this->_db->update ( self::TABLE, $arrFields, $arrConds );
	}
}

?>
