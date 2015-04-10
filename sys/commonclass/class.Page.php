<?php

/**
*   分页类
*
*   @author mraz <tonymark0714@gmail.com>
*/

class Page{
    
    public $pageSize;//一页显示几条数据
    public $pageCount;//总共几页
    public $rowCount;//总共几条记录
    public $currentPage;//当前第几页
    public $nextPage;//下一页
    public $prePage;//上一页
    public $table;//要查询的表名
    public $pageWhole;//显示页码数量
    public $gotoUrl;
    public $nav;
    public $order;
    public $where='';
    public $in='';
    
    function __construct() {
        
    }
    public function getIn() {
        return $this->in;
    }

    public function setIn($in) {
        $this->in = $in;
    }

        public function getWhere() {
        return $this->where;
    }

    public function setWhere($where) {
        $this->where = $where;
    }

        public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

        public function getGotoUrl() {
        return $this->gotoUrl;
    }

    public function setGotoUrl($gotoUrl) {
        $this->gotoUrl = $gotoUrl;
    }

        public function getPageWhole() {
        return $this->pageWhole;
    }

    public function setPageWhole($pageWhole) {
        $this->pageWhole = $pageWhole;
    }

            
    public function getRowCount() {
        return $this->rowCount;
    }

    public function setRowCount($rowCount) {
        $this->rowCount = $rowCount;
    }

        public function getPageSize() {
        return $this->currentPageSize;
    }

    public function getPageCount() {
        return $this->pageCount;
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function getNextPage() {
        return $this->nextPage;
    }

    public function getPrePage() {
        return $this->prePage;
    }

    public function getTable() {
        return $this->table;
    }

    public function setPageSize($pageSize) {
        $this->currentPageSize = $pageSize;
    }

    public function setPageCount($pageCount) {
        $this->pageCount = $pageCount;
    }

    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }

    public function setNextPage($nextPage) {
        $this->nextPage = $nextPage;
    }

    public function setPrePage($prePage) {
        $this->prePage = $prePage;
    }

    public function setTable($table) {
        $this->table = $table;
    }
    
    public function getNav() {
        return $this->nav;
    }

    public function setNav() {
        
        //显示首页
        $navigate = "<a class='button' href='{$this->gotoUrl}&page=1'>首页</a>&nbsp;";
        //显示上一页
        if($this->currentPage>1){
                $prePage=$this->currentPage-1;
                $navigate.="<a class='button' href='{$this->gotoUrl}&page=$prePage'>上一页</a>&nbsp;";
        }else{
                $navigate.="<font>上一页</font>&nbsp;";
        }

        //显示页码
        $start=floor(($this->currentPage-1)/$this->pageWhole)*$this->pageWhole+1;
        $index=$start;

        //显示前 $this->pageWhole 页
        if($this->currentPage>$this->pageWhole){
                $navigate.="<a class='button' href='{$this->gotoUrl}&page=".($start-1)."'><<</a>&nbsp;";
        }
        //显示页码
        for( ; $start<$index+$this->pageWhole; $start++){
                $class = $this->currentPage==$start? "":"button";
                $navigate.="<a class='$class' href='{$this->gotoUrl}&page=$start'>$start</a>&nbsp;";
        }

        //显示后$this->pageWhole页
        $navigate.="<a class='button' href='{$this->gotoUrl}&page=$start'>>></a>&nbsp;";

        //显示下一页
        if($this->currentPage<$this->pageCount){
                $nextPage=$this->currentPage+1;
                $navigate.="<a class='button' href='{$this->gotoUrl}&page=$nextPage'>下一页</a>&nbsp;";
        }else{
                $navigate.="<font>下一页</font>&nbsp;";
        }

        //显示尾页
        $navigate.="<a class='button' href='{$this->gotoUrl}&page=$this->pageCount'>尾页</a>&nbsp;";

        //显示当前页和共有多少页
        $navigate.="当前页{$this->currentPage}/共{$this->pageCount}页&nbsp;";
        
        //显示记录数
        $navigate.="&nbsp;共{$this->rowCount}条记录&nbsp;";
        
        $this->nav = $navigate;
    }
    
    public function setNav2() {
        
        //显示首页
        $navigate = "<a class='button' href='{$this->gotoUrl}&page=1'>首页</a>&nbsp;";
        //显示上一页
        if($this->currentPage>1){
                $prePage=$this->currentPage-1;
                $navigate.="<a class='button' href='{$this->gotoUrl}&page=$prePage'>上一页</a>&nbsp;";
        }else{
                $navigate.="<font>上一页</font>&nbsp;";
        }

        //显示页码
        $start=floor(($this->currentPage-1)/$this->pageWhole)*$this->pageWhole+1;
        $index=$start;

        //显示前 $this->pageWhole 页
        if($this->currentPage>$this->pageWhole){
                $navigate.="<a class='button' href='{$this->gotoUrl}&page=".($start-1)."'><<</a>&nbsp;";
        }
        //显示页码
        for( ; $start<$index+$this->pageWhole; $start++){
                $class = $this->currentPage==$start? "":"button";
                $navigate.="<a class='$class' href='{$this->gotoUrl}&page=$start'>$start</a>&nbsp;";
        }

        //显示后$this->pageWhole页
        $navigate.="<a class='button' href='{$this->gotoUrl}&page=$start'>>></a>&nbsp;";

        //显示下一页
        if($this->currentPage<$this->pageCount){
                $nextPage=$this->currentPage+1;
                $navigate.="<a class='button' href='{$this->gotoUrl}&page=$nextPage'>下一页</a>&nbsp;";
        }else{
                $navigate.="<font>下一页</font>&nbsp;";
        }

        //显示尾页
        $navigate.="<a class='button' href='{$this->gotoUrl}&page=$this->pageCount'>尾页</a>&nbsp;";

        //显示当前页和共有多少页
        $navigate.="当前页{$this->currentPage}/共{$this->pageCount}页&nbsp;";
        
        
        $this->nav = $navigate;
    }
    
}