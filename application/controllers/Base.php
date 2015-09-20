<?php
/**
 * @name ErrorController
 * @desc 错误控制器, 在发生未捕获的异常时刻被调用
 * @see http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author wangjian
 */
class BaseContoller extends Yaf_Controller_Abstract{
	public function apiResponse($data, $errno=0, $errmsg='') {
		if(!is_array($data)) {
			throw new Exception();
		}
		$response = array(
			'errno' => $errno ,
			'errmsg' =>$errmsg,
			'data' => $data 
		);
		echo json_encode($response);
	}
}

?>