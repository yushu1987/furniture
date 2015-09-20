<?php

/**
 * @name Product
 * @desc Product数据获取类, 可以访问数据库，文件，其它系统等
 * @author wangjian
 */
class Product extends Base {
	const TABLE = 'product';
	const HOT =1;
	const PAGE = 10; //默认翻页是10
	public static $arrFields = array (
			'id',
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
			'hot',
			'createTime',
			'status' 
	);
	public function getProductInfoById($pid) {
		if (empty ( $this->_db )) {
			$this->_db = self::getDB ( self::DATABASE );
		}
		$arrConds = self::getConds ( [ 
				'id' => $pid 
		] );
		$ret = $this->_db->select ( self::TABLE, self::$arrFields, $arrConds, null, null );
		return count ( $ret ) > 0 ? $ret : array ();
	}
	public function getHotProductList() {
		if (empty ( $this->_db )) {
			$this->_db = self::getDB ( self::DATABASE );
		}
		$arrConds = self::getConds(['hot' => self::HOT]);
		$arrAppends = array('order by id desc', 'limit '.self::PAGE);
		$ret = $this->_db->select(self::TABLE, self::$arrFields, $arrConds, null, $arrAppends);
		return count ( $ret ) > 0 ? $ret : array ();
	}
	public function getProductList($filter=array(), $order= array(),$pn=0, $rn=10) {
		$arrConds = self::getConds($filter);
		$orders = implode(',', $order);
		$arrAppends = array("order by $orders", "offset $pn limit $rn");
		$ret  = $this->_db->select(self::TABLE, self::$arrFields, $arrConds, null ,$arrAppends);
		return count ( $ret ) > 0 ? $ret : array ();
	}
	public function addProduct($arrInput) {
		$arrFields = array(
			'name' => trim($arrInput['name']),
			'type' => intval($arrInput['type']),
			'shop' => trim($arrInput['shop']),
			'standard' => trim($arrInput['standard']),
			'price' => intval($arrInput['price']),
			'color' => trim($arrInput['color']),
			'area' => trim($arrInput['area']),
			'model' => trim($arrInput['model']),
			'material' =>trim($arrInput['material']),
			'picture' => $arrInput['picture'],
			'fabrics' => $arrInput['fabrics'],
			'series' => $arrInput['series'],
			'hot' => 0,
			'createTime' => time(),
			'status' => 0,
 		);
		if (empty ( $this->_db )) {
			$this->_db = self::getDB ( self::DATABASE );
		}
		return $this->_db->insert(self::TABLE, $arrFields, null, null);
	}
	public function setHotProduct($pid, $hot) {
		return $this->updateProduct($pid, ['hot' => $hot]);
	}
	public function setStatusProduct($pid, $status) {
		return $this->updateProduct($pid, ['status' => $status]);
	} 
	public function updateProduct($pid, $arrFields) {
		$arrConds = self::getConds(['id' => $pid]);
		if (empty ( $this->_db )) {
			$this->_db = self::getDB ( self::DATABASE );
		}
		return $this->_db->update(self::TABLE, $arrFields, $arrConds);
	}
	
}

?>