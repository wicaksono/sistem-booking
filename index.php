<?php
define('YII_DEBUG', FALSE);

defined('APPLICATION_NAME') ||
    define('APPLICATION_NAME', 'SINDO Booking');

defined('APPLICATION_PATH') ||
    define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/protected'));

require_once(APPLICATION_PATH . '/framework/yiilite.php');
Yii::createWebApplication(APPLICATION_PATH . '/configs/production.php')->run();
