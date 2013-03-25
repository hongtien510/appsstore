<?php

class AjaxController extends App_Controller_FrontController {

    public function init() {
        parent::init();
    }

    public function indexAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $store = $this->view->info = App_Models_StoreModel::getInstance();
		//$data = $store->InsertDeleteUpdateQuery($sql);
        //echo'aaaaaaaaaaaa';
        
		include "class.phpmailer.php"; 
		include "class.smtp.php";
        include "sendmail.php";
		
	
        
         $hoten = $_POST['hoten'];
         $sdt = $_POST['sdt'];
         $email = $_POST['email'];
         $diachi = $_POST['diachi'];
         $sanpham = $_POST['sanpham'];
         $ghichu = $_POST['ghichu'];
        
        
        /*
        $mailfrom = "hongtien510@gmail.com";
        $mailto = "hongtien.51090@gmail.com";
        $nameto = "Ph?m H?ng Ti?n";
        $namefrom = "CTY TTQC ISHALI";
        $namereplay = "CTY TTQC ISHALI";
        $subject = "HELLLLLLO";
        $noidung = "TEST SEND MAIL";
        $result = sendmail($mailfrom, $mailto, $nameto, $namefrom, $namereplay, $subject, $noidung);
        sendmail($mailto, $mailfrom, $nameto, $namefrom, $namereplay, $subject, $noidung);
        */
        $result = 1;
        
        if($result==1)
        {
            $kq=array('result'=>1);
            echo Zend_Json::encode($kq);
        }
        if($result==0)
        {
            $kq=array('result'=>0);
            echo Zend_Json::encode($kq);
        }
    }
    
    

   

}
