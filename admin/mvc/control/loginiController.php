<?php 

class loginiController extends Controller{
    
    public function index(){
        if(isset($_POST['username']) && $_POST['username']!='' && isset($_POST['pwd']) && $_POST['pwd']!=''){
            $username = $_POST['username'];
            $pwd = $_POST['pwd'];
            $adminmodel = new AdminModel();
            $flag = $adminmodel->login($username,$pwd);
            if($flag==1){
                echo "<script>alert('用户名错误');</script>";
                echo "<script>window.location.href='admin.php?c=logini';</script>";
            }elseif($flag==2){
                echo "<script>alert('密码错误');</script>";
                echo "<script>window.location.href='admin.php?c=logini';</script>";
            }elseif($flag==0){
//                echo "<script>alert('登录成功');</script>";
                echo "<script>window.location.href='admin.php?c=product&a=managecolumn';</script>";
            }
            
        }
        
        $this->render("ht_login",array());
    }
    
    public function logout(){
        $_SESSION['username'] = '';
        unset($_SESSION['username']);
        $this->redirect("admin.php?c=logini");
    }
    
    
    
}