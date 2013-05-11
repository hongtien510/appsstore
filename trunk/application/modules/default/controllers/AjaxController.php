<?php

class AjaxController extends App_Controller_FrontController {

    public function init() {
        parent::init();
    }

    public function indexAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $store = $this->view->info = App_Models_StoreModel::getInstance();

        
		include "class.phpmailer.php"; 
		include "class.smtp.php";
        include "sendmail.php";
		
	
        
         $hoten = $_POST['hoten'];
         $sdt = $_POST['sdt'];
         $email = $_POST['email'];
         $diachi = $_POST['diachi'];
         $sanpham = $_POST['sanpham'];
         $ghichu = $_POST['ghichu'];
        
		
		
		
	
		
		$usersmtp = "hongtien510@ishali.com.vn";
		$passsmtp = "phamhongtien510";

		
		$mailto = $email;
		$nameto = $hoten;
		$namefrom = "ISHALI MEDIA - SOCIAL MEDIA MARKETING";
		$namereplay = "ISHALI MEDIA - SOCIAL MEDIA MARKETING";
		$subject = "Cảm ơn bạn ". $hoten ." đã quan tâm đến dịch vụ của Ishali Media";
			
		$noidung = "Chào bạn " . $hoten ."<br/>";
		$noidung.= "Chúng tôi đã nhận thông tin đặt hàng của bạn<br/>";
		$noidung.= "Sản phẩm mà bạn đã đặt hàng<br/>";
		$noidung.= "Áo Sơ Mi - MS-001";
		$noidung.= "<table><tr><td width = '80' height = '80' background='http://ishali.com.vn/public/default/images/logo.png'></td><td valign='bottom'>ISHALI MEDIA<br/>SOCIAL MEDIA MARKETING</td></tr></table>";
		
		$subject_reply = "KH (" . $hoten . " - " . $sdt . ") đã đăng ký ";
		$noidung_reply = "<b>Thông Tin Khách Hàng</b><br/>";
		$noidung_reply .= "<b>Họ Tên KH : </b>" . $hoten . ".<br/>";
		$noidung_reply.= "<b>Số Điện Thoại : </b>" . $sdt . ".<br/>";
		$noidung_reply.= "<b>Email : </b>" . $email . ".<br/>";
		$noidung_reply.= "<b>Địa chỉ : </b>" . $diachi . ".<br/>";
		$noidung_reply.= "<b>Ghi chú : </b>" . $ghichu . ".<br/>";
		$noidung_reply.= "<b>Sản phẩm : </b>" . $sanpham . ".<br/>";
			
		$mailfrom = $usersmtp;//Email khi KH tra loi
			$result = sendmail($usersmtp, $passsmtp, $mailfrom, $mailto, $nameto, $namefrom, $namereplay, $subject, $noidung);
					  sendmail($usersmtp, $passsmtp, $mailto, $mailfrom, $namefrom, $namefrom, $nameto, $subject_reply, $noidung_reply);
			
			
		if($result == '1')
		{
			$kq=array('result'=>1);
			echo json_encode($kq);
		}
		else
		{
			$kq=array('result'=>0);
			echo json_encode($kq);
		}	
    }
    
    

   

}
