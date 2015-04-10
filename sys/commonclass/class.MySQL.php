<?php

/**
*	MySQL工具类，完成对数据库的操作
*
*	@author mraz <tonymark0714@gmail.com>
*/

class MySQL{
	
	public $con;
	
	public function MySQL($db){
        $dbconfig = include_once(sys_dir.'dbconfig.php');//载入数据库配置文件

        $this->con = mysql_connect($dbconfig[$db]['db_host'],$dbconfig[$db]['db_usr'],$dbconfig[$db]['db_pwd']);
        if(!$this->con){
        	die("cannot connect ".mysql_error());
        }
        mysql_select_db($dbconfig[$db]['db_name'], $this->con) or die(mysql_errno());
        mysql_query("set names ".$dbconfig[$db]['db_charset'],$this->con);
    }

	//执行dql语句的方法，返回结果集
    public function execute_dql2($sql){
    	$result = mysql_query($sql,$this->con) or die(mysql_error());
    	return $result;
    }
	//执行dql语句，返回一个二维数组，把结果集放入数组中，所以在该方法里就结束资源了
    public function execute_dql($sql){
    	$arr = array();
    	$result = mysql_query($sql,$this->con) or die(mysql_error());
    	$i=0;
    	while($row = mysql_fetch_array($result)){
    		$arr[$i++]=$row;
    	}

    	mysql_free_result($result);
    	return $arr;
    }


	//执行dml语句的方法
    public function execute_dml($sql){
    	$b = mysql_query($sql,$this->con) or die(mysql_error());
    	if(!$b){
			return 0;//失败
		}else{
			if(mysql_affected_rows($this->con)>0){
				return 1;//表示执行ok
			}else{
				return 2;//表示没有行受到影响
			}
		}
	}

	public function get_insert_id(){
		return mysql_insert_id();
	}

	//关闭连接的方法
	public function close_connect(){
		if(!empty($this->con)){
			mysql_close($this->con);
		}
	}

	public function execute_count($sql){
		$res=mysql_query($sql,$this->con) or die(mysql_error());

		if($row=mysql_fetch_row($res)){
			$count = $row[0];
		}
		mysql_free_result($res);
		return $count;
	}
	
	//考虑分页情况的查询，通用分页
	//$sql1= "select * from where 表名 limit 0,6"
	//$sql2= "select count(id) from 表名"
	public function execute_dql_fenye($sql1,$sql2,$fenyePage){
		
		$arr = array();
		$result = mysql_query($sql1,$this->con) or die(mysql_error());
		
		while($row = mysql_fetch_array($result)){
			$arr[]=$row;
		}
		mysql_free_result($result);
		
		$res=mysql_query($sql2,$this->con) or die(mysql_error());
		
		if($row=mysql_fetch_row($res)){
			$fenyePage->pageCount = ceil($row[0]/$fenyePage->pageSize);
			$fenyePage->rowCount = $row[0];
		}
		mysql_free_result($res);
		
		//显示首页
		$navigate = "<a href='{$fenyePage->gotoUrl}?pageNow=1'>首页</a>&nbsp;";
		//显示上一页
		if($fenyePage->pageNow>1){
			$prePage=$fenyePage->pageNow-1;
			$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$prePage'>上一页</a>&nbsp;";
		}else{
			$navigate.="<font>上一页</font>&nbsp;";
		}
		
		//显示页码
		$page_whole=10;//整体翻10页
		$start=floor(($fenyePage->pageNow-1)/$page_whole)*$page_whole+1;
		$index=$start;
		
		//显示前10页
		if($fenyePage->pageNow>10){
			$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=".($start-1)."'><<</a>&nbsp;";
		}
		//显示页码
		for( ; $start<$index+$page_whole; $start++){
			$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$start'>[$start]</a>&nbsp;";
		}
		
		//显示后10页
		$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$start'>>></a>&nbsp;";
		
		//显示下一页
		if($fenyePage->pageNow<$fenyePage->pageCount){
			$nextPage=$fenyePage->pageNow+1;
			$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$nextPage'>下一页</a>&nbsp;";
		}else{
			$navigate.="<font>下一页</font>&nbsp;";
		}
		
		//显示尾页
		$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$fenyePage->pageCount'>尾页</a>&nbsp;";
		
		//显示当前页和共有多少页
		$navigate.="当前页{$fenyePage->pageNow}/共{$fenyePage->pageCount}页";
		
		$fenyePage->res_array = $arr;
		$fenyePage->navigate = $navigate;
	}
	
}

