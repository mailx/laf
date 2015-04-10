<?php

/**
*   Model超类
*
*   @author mraz <tonymark0714@gmail.com>
*/

class AR{
    
    private $mysql;
    
    public function AR($db) {
        $this->mysql = new MySQL($db);
    }
    
    public function query_dql($sql){
        $res = $this->mysql->execute_dql($sql);
        return $res;
    }
    
    public function query_dml($sql){
        $res = $this->mysql->execute_dml($sql);
        return $res;
    }

    public function get_insert_id(){
        return $this->mysql->get_insert_id();
    }
    
    public function getPageData(&$page_model){
        $table = $page_model->getTable();
        $where = $page_model->getWhere();
        if($where!='')
            $where = "where {$where}";
        $sql = "select count(id) from ".$table." {$where}";
        
        $count = $this->mysql->execute_count($sql);
        $page_model->setRowCount($count);//设置总共记录数
        
        $pageCount = ceil($count/$page_model->getPageSize());
        $page_model->setPageCount($pageCount);//设置总共页数
        
        $offset = $page_model->getPageSize() * ($page_model->getCurrentPage()-1);
        $sql = "select * from ".$table." {$where} order by ".$page_model->getOrder()." desc limit ".$offset.",".$page_model->getPageSize()." ;";
//        var_dump($sql);exit;
        $res = $this->query_dql($sql);
        $page_model->setNav();
//        $this->mysql->close_connect();
        return $res;
        
    }
    
    public function getPageData2(&$page_model,$mcid,$scid){
        if($scid!=''){
            $page_model->setGotoUrl("index.php?c=product&scid={$scid}");
            $page_model->setWhere("fdColumnID={$scid}");
            $page_model->setOrder("fdOrder");
        }elseif ($mcid!='') {
            $sql = "select id from tbColumn where fdParentID={$mcid}";
            $res = $this->query_dql($sql);
            $columnid_arr = array();
            if(!empty($res)){
                foreach ($res as $value) {
                    $columnid_arr[] = $value['id'];
                }
                $columnid_str = implode(",", $columnid_arr);
                $page_model->setWhere(" fdColumnID ");
                $page_model->setIn($columnid_str);
                $page_model->setOrder("fdOrder");
                $page_model->setGotoUrl("index.php?c=product&mcid={$mcid}");
            }
        }  else {
            $page_model->setGotoUrl("index.php?c=product");
            $page_model->setOrder("fdCreate");
        }
        
        $table = $page_model->getTable();
        $where = $page_model->getWhere();
        $in = $page_model->getIn();
        if($where!='')
            $where = "where {$where}";
        if($in!='')
            $in = "in ({$in})";
        
        $sql = "select count(id) from ".$table." {$where}";
        
        $count = $this->mysql->execute_count($sql);
        $page_model->setRowCount($count);//设置总共记录数
        
        $pageCount = ceil($count/$page_model->getPageSize());
        $page_model->setPageCount($pageCount);//设置总共页数
        
        $offset = $page_model->getPageSize() * ($page_model->getCurrentPage()-1);
        $sql = "select * from ".$table." {$where} {$in} order by ".$page_model->getOrder()." desc limit ".$offset.",".$page_model->getPageSize()." ;";
//        var_dump($sql);exit;
        $res = $this->query_dql($sql);
        $page_model->setNav();
//        $this->mysql->close_connect();
        return $res;
        
    }
    
    
    public function insert($tableName,$data_arr){
//      $sql = "insert into tbUser(fdLogin,fdPassword) values ('admin','admin');";
        $column_arr = array();
        $value_arr = array();
        foreach ($data_arr as $column => $value) {
            $column_arr[] = $column;
            $value_arr[] = $value;
        }
        $column = implode(",", $column_arr);
        $value = implode(',', $value_arr);
        $sql = "insert into ".$tableName."(".$column.") values (".$value.")";
        return $this->mysql->execute_dml($sql);
    }
    
    
}