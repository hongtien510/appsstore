<?php

class Admin_IndexController extends App_Controller_AdminController {

    public function init() {
        parent::init();
        $this->_SESSION=new Zend_Session_Namespace();
    }

    public function indexAction() {
        if(!isset($this->_SESSION->iduseradmin))
		{
			$link_login = APP_DOMAIN."/admin/login";
			header("Location:$link_login");
		}
		
		$_SESSION['list_page'] = "0";

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
		$store = $this->view->info = App_Models_StoreModel::getInstance();
		
		$pageid = $_GET['pageid'];
		$pagename = $_GET['pagename'];
		$userid = $_GET['userid'];
		$appid = $_GET['appid'];
		$status = $_GET['status'];
		
		if($status == 1)
		{
			$sql = "Select 1 from ishali_pages where id_fb_page = '". $pageid ."' and id_fb = '". $userid ."'";
			$data = $store->SelectQuery($sql);
			if(count($data) > 0)
			{
				echo "<script>ThongBaoDongY('Ứng dụng này đã được cài lên Fanpage<br/><u>$pagename</u>.', '".ROOT_DOMAIN."/admin');</script>";	
			}
			else
			{
				$link = "http://www.facebook.com/add.php?api_key=$appid&pages=1&page=$pageid";
				echo "<script>customerLoadWindow('$link', '', '540', '400');</script>";
				
				$sql = "Insert into ishali_pages(id_fb_page, page_name, id_fb, templates) value(";
				$sql.= "'".$pageid."', ";
				$sql.= "'".$pagename."', ";
				$sql.= "'".$userid."', ";
				$sql.= "'tmpstore') ";
				
				$data = $store->InsertDeleteUpdateQuery($sql);
				
				if($data == 1)
				{
					echo "<script>ThongBaoDongY('Sau khi cài ứng dụng lên FanPage thành công,<br/>Hãy nhấn nút Đóng', '".ROOT_DOMAIN."/admin');</script>";	
				}
				else
				{
					echo "<script>ThongBaoDongY('Lưu không thành công<br/>Vui Lòng thực hiện lại thao tác.', '".ROOT_DOMAIN."/admin');</script>";
				}
			}
		}
		else
		{
			$link = "http://www.facebook.com/add.php?api_key=$appid&pages=1&page=$pageid";
				echo "<script>customerLoadWindow('$link', '', '540', '400');</script>";
			echo "<script>ThongBaoDongY('Sau khi cài ứng dụng lên FanPage thành công,<br/>Hãy nhấn nút Đóng', '".ROOT_DOMAIN."/admin');</script>";	

		}
    }
}

