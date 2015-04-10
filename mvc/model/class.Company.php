<?php

class Company extends AR{
    
    function __construct() {
        parent::__construct('db2');//设置数据库
    }
    
    public function setContent($content){
        $contentID = $this->getContentID();
        $sql = "update tbBlob set fdValue='".$content."' where fdContentID=".$contentID." AND fdAttributeID=2;";
        $flag = $this->query_dml($sql);
        
        return $flag;
    }
    
    public function getContentID(){
        
        $sql = "select * from tbContent where fdTypeID=".company_typeid.";";
        $res = $this->query_dql($sql);
        foreach ($res as $value) {
            $contentID = $value['id'];
        }
        return $contentID;
    }
    
    public function getContent(){
        $contentID = $this->getContentID();
        $sql = "select * from tbBlob where fdContentID=".$contentID." AND fdAttributeID=2;";
        $res = $this->query_dql($sql);
        $content = '';
        foreach ($res as $value) {
            $content = $value['fdValue'];
        }
        return $content;
    }

    public function test(){
        return "laf is work!";
    }
    
    
    
    
}