<?php


define('controllertag','c');//controller标签
define('actiontag','a');//action标签
define('guesturl',"'',index,product,company,service,press,contact,news");//前台允许访问的controller
define('adminurl',"'',admin,index,product,company,service,press,contact,news,logini");//后台允许访问的controller

define('defaultindex',"index");//前台默认页
define('defaultadminindex',"index");//后台默认页

define('root_dir',str_replace("\\",'/',dirname(dirname(__FILE__))));//项目根目录
define('sys_dir',root_dir."/sys/");//框架目录
define('sys_dir_class',sys_dir."commonclass/");//框架的类目录
define('sys_dir_func',sys_dir."commonfunc/");//框架的函数目录
define('upload_dir',root_dir."/upload/");//上传文件目录
//define('var_dir_log',root_dir."/var/log/");
define('usr_dir',root_dir."/mvc/");//前台mvc目录
define('usr_dir_control',usr_dir."control/");//前台控制器目录
define('usr_dir_model',usr_dir."model/");//前台模块目录
define('usr_dir_view',usr_dir."view/");//前台视图目录
define('admin_dir',root_dir."/admin/mvc/");//后台mvc目录
define('admin_dir_control',admin_dir."control/");//后台控制器目录
define('admin_dir_model',admin_dir."model/");//后台模块目录
define('admin_dir_view',admin_dir."view/");//后台视图目录
define('lib_dir',root_dir."/lib/");//库文件目录

