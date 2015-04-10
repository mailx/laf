<?php

class AdminModel extends AR{
    
    function __construct() {
        parent::__construct('db3');//设置数据库
    }
    
    public function login($username,$pwd){
        $sql = "select * from tbUser where id=1;";
        $res = $this->query_dql($sql);
        foreach ($res as $value) {
            if($username != $value['fdLogin']){
                return 1;
            }  elseif($pwd != $value['fdPassword']) {
                return 2;
            }  else {
                
                $_SESSION['username'] = $value['fdLogin'];
                return 0;
            }
        }
        
    }
    
    public function editPwd($pwd){
        $sql = "update tbUser set fdPassword='{$pwd}' where id=1;";
        $flag = $this->query_dml($sql);
        return $flag;
    }
    
    
    
    
    
}