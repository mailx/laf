<?php 

/**
*   系统框架类
*
*   @author mraz <tonymark0714@gmail.com>
*/

class System{
    
    private $ctrl_url;
    private $action_url;
    public $isadmin=false;//是否后台的入口文件
    private $dbconfig;
            
    function __construct() {
        
        
    }
    

    public function run(){
        define("isadmin", $this->isadmin);
        
        /**引入全部类文件开始**/
        if(!$this->isadmin){
            $classes_dir = array(sys_dir_class,usr_dir_model);
        }else{
            $classes_dir = array(sys_dir_class,admin_dir_model);
        }
        foreach ($classes_dir as $dir) {
            $handle=opendir($dir);
            while($file=readdir($handle)) {
                if (($file!=".") && ($file!="..") && strpos($file,".php")) {
                    include_once $dir.$file;
                }
            }
            closedir($handle); 
        }
        /**引入全部类文件结束**/
        
		if(!$this->isadmin){
			$allowurl=explode(',',guesturl);
		}else{
			$allowurl=explode(',',adminurl);
		}
		
		$ctrl=isset($_GET[controllertag])?$_GET[controllertag]:'';
		$action=isset($_GET[actiontag])?$_GET[actiontag]:defaultindex;
		if(in_array($ctrl,$allowurl)){
			$this->ctrl_url=$ctrl;
		}else if($ctrl==''){
			if($this->isadmin){
				$this->ctrl_url=defaultadminindex;
			}else{
				$this->ctrl_url=defaultindex;
			}
		}else{
//			include_once("err.php");
//                    echo '这个controller没有被允许';
                    echo "<script>window.location.href='index.php'</script>";
                    exit;
		}
		
		$this->action_url=$action;	
		
		if(!$this->isadmin){
			$runfile=usr_dir_control.$this->ctrl_url."Controller.php";
		}else{
			$runfile=admin_dir_control.$this->ctrl_url."Controller.php";
		}
		if(is_file($runfile)){
			include_once($runfile);
                        define('controllerid', $this->ctrl_url);//定义一个controllerid常量                      
			$ctrl_model=&loadclass($this->ctrl_url."Controller");
			if($this->action_url!='' && method_exists($this->ctrl_url."Controller",$this->action_url)){
				$ctrl_method=$this->action_url;
				//$ctrl->$method();
				loadmethod($ctrl_model,$ctrl_method);
                                define('actionid', $this->action_url);//定义一个actionid常量 
			}else{
//                            echo '该controller没有这个方法'.$this->action_url;
                            echo "<script>window.location.href='index.php'</script>";
//				include_once("err.php");
			}
			$ctrl_model=null;
			unset($ctrl_model);
		}else{
//                        echo "没有这个controller文件";
                        echo "<script>window.location.href='index.php'</script>";
//			include_once("err.php");
		}
	}
    
}