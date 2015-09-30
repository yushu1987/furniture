<?php
/**
 *
 * @author Administrator
 *        
 */
class OrdersController  extends BaseController{
	public function infoAction () {
		if(!$this->requestParams['orderId']) {
			throw new AppException(AppExceptionCodes::INVALID_ORDERID);
		}
		$objOrders = new OrdersModel();
		$orderInfo = $objOrders->getOrderInfoById($this->requestParams['orderId']);
		if(empty($orderInfo)) {
			throw new AppException(AppExceptionCodes::INVALID_ORDERID);
		}
		$pids =  explode(',', $orderInfo['pids']);
		$objProduct = new ProductModel();
		foreach($pids as $pid) {
			$pinfo = $objProduct->getProductInfoById($pid);
		 	if($pinfo) {
		 		$orderInfo['pinfo'][] = $pinfo;
		 	}
		}
		$this->apiResponse(array('orderInfo' => $orderInfo));
	}
	
	public function handleAction() {
		$arrInput = self::_checkHandle($this->requestParams);
		$objOrders = new OrdersModel();
		$funcArr = array('cancelOrder','doneOrder','pendingOrder', 'overStatus');
		$func= $funcArr[$arrInput['status']-1];
		$ret= $objOrders->$func($arrInput['id']);
		if(!$ret) {
			throw new AppException(AppExceptionCodes::HANDLE_ORDER_FAILED);
		}
		$this->assign('data', array('ret'=> true, 'jumpUrl'=>'/orders/pclist?status='.$arrInput['status']));
		$this->display('page/jump.tpl');
	}
	
	public function pclistAction() {
		$status = isset($this->requestParams['status'])?intval($this->requestParams['status']):'';
		$pn = intval($this->requestParams['pn']);
		$objOrders = new OrdersModel();
		$list = $objOrders->getOrderList($pn, $status);
		if($list) {
			$objProduct = new ProductModel();
			foreach($list as &$item) {
				$pids = explode(',', $item['pids']);
				foreach($pids as $pid) {
					$pinfo = $objProduct->getProductInfoById($pid);
					if($pinfo) {
						$item['pinfo'][] = $pinfo;
					}
				}
			}
		}
		$this->assign('data', $list);
		$this->display('page/orders.tpl');
	}

	public function addAction() {
		$arrInput = self::_checkParam($this->requestParams);
		$objOrders = new OrdersModel();
		$objOrders->startTransaction();
		$orderId = $objOrders->addOrder($arrInput);
		$objProduct = new ProductModel();
		if($orderId) {
			foreach($arrInput['pids'] as $pid) {
				$ret = $objProduct->incSoldProduct($pid);
				if(!$ret) {
					$objOrders->rollback();
					throw new AppException(AppExceptionCodes::NEW_ORDER_FAILED);
				}
			}	
		}else {
			$objOrders->rollback();
			throw new AppException(AppExceptionCodes::NEW_ORDER_FAILED);
		}
		$objOrders->commit();
		$this->apiResponse(array('orderId' => $orderId));
	}
	private function _checkParam($arrInput) {
		if(empty($arrInput['pids'])||empty($arrInput['uname'])||empty($arrInput['phone'])||empty($arrInput['address'])){
			throw new AppException(AppExceptionCodes::PARAM_ERROR);
		}
		if(strlen($arrInput['phone']) != 11 && strlen($arrInput['phone']) !=8) {
			throw new AppException(AppExceptionCodes::INVALID_PHONE);
		}
		$arrInput['pids'] = explode(',', $arrInput['pids']);
		if(empty($arrInput['pids'])) {
			throw new AppException(AppExceptionCodes::PARAM_ERROR);
		}
		$amount=0;
		$objProduct = new ProductModel();
		foreach($arrInput['pids'] as $pid) {
			$pinfo = $objProduct->getProductInfoById($pid);
			if(empty($pinfo)) {
				throw new AppException(AppExceptionCodes::INVALID_PID);
			}
			$amount += $pinfo['price'];
		}
		$arrInput['amount']= $amount;
 		return $arrInput;
	}
	
	private function _checkHandle($arrInput) {
		if(empty($arrInput['id']) || empty($arrInput['status'])) {
			throw new AppException(AppExceptionCodes::PARAM_ERROR);
		}
		return $arrInput;
	}
	
}

?>
