<?php
/**
 *
 * @author Administrator
 *        
 */
class OrdersController  extends BaseController{
	//还有问题
	public function infoAction () {
		 if(!$this->requestParams['orderId']) {
		 	throw new AppException(AppExceptionCodes::INVALID_ORDERID);
		 }
		 $objOrders = new OrdersModel();
		 $orderInfo = $objOrders->getOrderInfoById($orderId);
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
	//还有问题
	public function addAction() {
		$arrInput = self::_checkParam($this->requestParams);
		$objOrders = new OrdersModel();
		$objOrders->startTransaction();
		foreach($arrInput['pids'] as $pid) {
			$orderId = $objOrders->addOrder($arrInput);
			if($orderId) {
				$objProduct = new ProductModel();
				$ret = $objProduct->incSoldProduct($pid);
				if(!$ret) {
					throw new AppException(AppExceptionCodes::NEW_ORDER_FAILED);
				}
			}
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
		foreach($arrInput['pids'] as $pid) {
			$objProduct = new ProductModel();
			$pinfo = $objProduct->getProductInfoById($pid);
			if(empty($pinfo)) {
				throw new AppException(AppExceptionCodes::INVALID_PID);
			}
			$amount += $pinfo['price'];
		}
		$arrInput['$amount']= $amount;
 		return $arrInput;
	}
	
}

?>