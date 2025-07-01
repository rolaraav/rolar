<?php
//Поменяйте эту цифру с 0 на 1 для включения режима вывода ошибок детально
$debug_mode = 0;

$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

if ($debug_mode){
    error_reporting (E_ALL ^ E_NOTICE);
    defined('YII_DEBUG') or define('YII_DEBUG',true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
}
else {
    error_reporting (0);
}
require_once($yii);
Yii::createWebApplication($config)->run();