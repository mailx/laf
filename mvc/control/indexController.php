<?php

class indexController extends Controller{
    
    public function index(){
        
    	$company_model = new Company();

    	$str = $company_model->test();

        $this->render('index',array("data"=>$str));
    }
    
    
    
}