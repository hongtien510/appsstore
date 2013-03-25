<?php

class Admin_IndexController extends App_Controller_AdminController {

    public function init() {
        parent::init();
        
    }

    public function indexAction() {
        
        $facebookadmin = new Ishali_FacebookAdmin();  
        $facebook = new Ishali_Facebook();  
		$facebook->begins_works('1');
        
    	$manage_pages =  $facebookadmin->checkpermissions('manage_pages');
    	if ($manage_pages)
    	{
    	
		$this->view->appid = $facebook->getAppId();
	 	$this->view->fbuserid = $facebook->getuserfbid();
		$this->view->list_pages = $facebookadmin->list_pages($this->view->fbuserid, 'page');
		
		
		
//		$article = App_Models_ArticleModel::getInstance()->getDetail(1);    
//$time_start = microtime(true);
        $this->view->pageslist = App_Models_PagesModel::getInstance()->getList('a',10, 1, $this->view->fbuserid );
//        $time_end = microtime(true);
//$time = $time_end - $time_start;

//echo "Did nothing in $time seconds\n";
//        $mausac = App_Models_BangmauModel::getInstance()->getList();
//            echo "<pre>";
//        print_r( $this->view->pageslist);
//        echo "</pre>";
////        exit;	
        
    	}else {
    		$facebookadmin->install();
    	}
        
    }

    public function installpageAction() {
    	
    	 $layoutPath = APPLICATION_PATH . '/templates/giaodien_admin';
        $option = array('layout' => 'install', 'layoutPath' => $layoutPath);
        Zend_Layout::startMvc($option);

     App_Models_PagesModel::getInstance()->checkHasAddedApp();
    }
}

