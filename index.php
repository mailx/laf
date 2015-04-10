<?php
date_default_timezone_set("PRC");
include_once('sys/config.php');//载入配置文件
include_once('sys/params.php');//载入项目常量文件
include_once(sys_dir_func.'func.php');//载入系统函数
include_once(sys_dir_class.'class.System.php');//载入系统类

$obj=&loadclass('System');
$obj->isadmin=false;
$obj->run();
unset($obj);