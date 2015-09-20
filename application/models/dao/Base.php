<?php

class Base {
	public $_db;
	public $_server;
	const DATABASE = 'channel';
	public $hosts;
	
	public function getDB($strDbName) {
		$this->hosts = Conf::getDBConf();
		if (empty ( $this->hosts )) {
			Yii::log ( "get database[$strDbName] error. for conf empty" , 'error');
			return false;
		}
		if (empty ( $this->_db )) {
			extract ( $this->hosts );
			$this->_db = new DB ();
			$ret = $this->_db->connect ( $ip, $user, $passwd, $strDbName, $port );
			if (! $ret) {
				Yii::log ( "connect database[$strDbName] error . for connect failed",'error' );
				return false;
			}
		}
		return $this->_db;
	}
	
	public function getConds($arrConds) {
		$arrCondsRes = null;
		foreach ( $arrConds as $key => $value ) {
			if (is_array ( $value )) {
				if (count ( $value ) == 2) {
					$arrCondsRes [$key . ' ' . $value [0]] = $value [1];
				} elseif (count ( $value ) == 4) {
					$arrCondsRes [$key . ' ' . $value [0]] = $value [1];
					$arrCondsRes [$key . ' ' . $value [2]] = $value [3];
				}
			} else {
				$arrCondsRes [$key . ' ='] = $value;
			}
		}
		return $arrCondsRes;
	}
}

?>
