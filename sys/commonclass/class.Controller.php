<?php

/**
*   Controller超类
*
*   @author mraz <tonymark0714@gmail.com>
*/

class controller{
    
    function __construct() {

        $this->filterRequest();

    }
    
    function render($view,$data=null){
        
        foreach ($data as $data_name => $data_value) {
            $$data_name = $data_value;
        }
        if(is_file(admin_dir_view.$view.".php")){
            include_once admin_dir_view.$view.".php";
        }else if(is_file(usr_dir_view.$view.".php")){
            include_once usr_dir_view.$view.".php";
        }
    }
    
    function redirect($url){
        echo "<script>window.location.href='$url';</script>";
        exit;
    }

    function filterRequest(){
        foreach ($_REQUEST as $key => $value) {
            if(!is_array($value)){
                $_REQUEST[$key] = addslashes($value);
            }
        }
    }
    
    
    
}