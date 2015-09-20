<?php

/**
 *
 * @author Administrator
 *        
 */
class App_Exception extends Exception {
	private $errno;
	private $errstr;
	public function __construct($errno) {
		$this->errno = $errno;
		$errstr = @App_Exception_Codes::$errMsg [$errno];
		if (! is_numeric ( $errno )) {
			$this->errstr = $errstr = $errno;
			$errno = $this->errno = App_Exception_Codes::CUSTOM_EXCEPTION;
		}
		if ($errstr == null) {
			$errstr = '---Errno msg not found . no:' . $errno;
		}
		$this->errstr = $errstr;
		
		parent::__construct ( $errstr, $errno );
	}
	public function getErrNo() {
		return $this->errno;
	}
	public function getErrStr() {
		return $this->errstr;
	}
	public function getDebugInfo() {
		return "报错文件：{$this->file}:{$this->line}";
	}
}

?>