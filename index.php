<?php
/**
 * 入口文件
 * @date 2015-9-16 6:14:26
 * @author wangjian
 * @version 1.0.0
 */
define("APP_PATH",  dirname(__FILE__));
define('APPLICATION_PATH', APP_PATH . '/application');
define('PIC_PATH', APPLICATION_PATH . '/static/picture');
$app = new Yaf_Application(APP_PATH."/conf/application.ini");
$app->bootstrap()->run();
