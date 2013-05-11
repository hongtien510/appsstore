<?php

class AjaxController extends App_Controller_FrontController {

    public function init() {
        parent::init();
    }

    public function indexAction() {
	
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
    

        include "sendmail.php";
		
		/*
        
        $hoten = $_POST['hoten'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $diachi = $_POST['diachi']; 
        $ghichu = $_POST['ghichu'];
        $sanpham = $_POST['sanpham'];
		
		$sql = "Select idsp, masp, tensp, gia, hinhchinh, mota, chitietsp ";
		$sql.= "From ishali_sanpham ";
		$sql.= "Where idsp = ". $sanpham;
		$store = $this->view->info = App_Models_StoreModel::getInstance();
		$data = $store->SelectQuery($sql);
		
		//print_r($data);
		
		$usersmtp = "hongtien510@ishali.com.vn";
		$passsmtp = "phamhongtien510";
		
		$mailfrom = "hongtien510@ishali.com.vn";//Email khi KH tra loi
		
		$mailto = $email;
		$nameto = $hoten;
		$namefrom = "ISHALI MEDIA";
		$namereplay = "ISHALI MEDIA";
		$subject = "Cảm ơn bạn ". $hoten ." đã quan tâm đến dịch vụ của Ishali Media";
		
		$noidung = "";
		$noidung.="<table width='600' border='1; cellpadding='0' cellspacing='0'>";
		$noidung.="<tr><td height='35' colspan='2'>Cảm ơn bạn <strong>Phạm Hồng Tiến</strong> đã đặt hàng tại Store ISHALI MEDIA.</td></tr>";
		$noidung.="<tr><td height='30' colspan='2'>Thông tin sản phẩm đặt hàng như sau:</td></tr>";
		
		$noidung.="<tr>";
		$noidung.="<td width='317' rowspan='4'>";
		$noidung.="<img src='https://ishalimedia.com/appfb/ishalistore//application/layouts/tmpstore/images/upload/images/1363321551_sm1.jpg' width='300' height='349' /></td>";
		$noidung.="<td height='30' valign='top'><strong>Tên SP</strong> : Áo Sơ Mi Nữ</td></tr>";
		$noidung.="<tr><td height='30' valign='top'><strong>Giá bán</strong> : 100.000 VNĐ</td></tr>";
		$noidung.="<tr><td height='100' valign='top'>Mô tả : ad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad ad</td></tr>";
		$noidung.="<tr><td width='273' height='155' valign='top'><strong>Chi tiết</strong> : ad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad ad</td></tr>";
		$noidung.="<tr><td height='30' colspan='2'>&nbsp;</td></tr>";
		
		$noidung.="<tr><td height='250' colspan='2' valign='top'><p><span style='color:#00F; font-weight:bold; font-size:18px'>Thông tin đơn đặt hàng:</span></p>";
		$noidung.="<p>Họ tên : Phạm Hồng Tiến</p>";
		$noidung.="<p>SĐT : 0949968938</p>";
		$noidung.="<p>Email : hongtien510@gmail.com</p>";
		$noidung.="<p>Địa chỉ : 281/39/9 Lê Văn Sỹ, P1, Tân Bình</p>";
		$noidung.="<p>Ghi chú : Gọi điện thoại trước khi giao hàng.</p></td>";
		$noidung.="</tr>";
		$noidung.="<tr><td height='45' colspan='2' valign='top'><p><em>Chúng tôi sẽ liên hệ sớm để xác nhận đơn hàng của bạn.<br/>Cảm ơn bạn đã quan tâm đến sản phẩm của chúng tôi.</em></p></td></tr>";
		$noidung.="</table>";
		
		
		$subject_reply = "KH (" . $hoten . " - " . $sdt . ") đã đăng ký nhận thông tin tài liệu Facebook, apps";
	
		$noidung_reply = "<b>Thông Tin Khách Hàng</b><br/>";
		$noidung_reply .= "<b>Họ Tên KH : </b>" . $hoten . ".<br/>";
		$noidung_reply.= "<b>Số Điện Thoại : </b>" . $sdt . ".<br/>";
		$noidung_reply.= "<b>Email : </b>" . $email . ".<br/>";
		$noidung_reply.= "<b>Địa chỉ : </b>" . $diachi . ".<br/>";
		$noidung_reply.= "<b>Ghi chú : </b>" . $ghichu . ".<br/>";
		$noidung_reply.= "<b>Sản phẩm : </b> Áo sơ mi nữ - Mã số 00001<br/>";
		
		
		//(1.EmailSMTP, 2.PassSMTP, 3.Email Gui, 4.Email Nhan, 5.Ten Nguoi Nhan, 6.Ten Nguoi Gui, 7.Ten Khi Tra Loi, 8.Tieu De, 9.Noi Dung)
		$result = sendmail($usersmtp, $passsmtp, $mailfrom, $mailto, $nameto, $namefrom, $namereplay, $subject, $noidung);
				  sendmail($usersmtp, $passsmtp, $mailto, $mailfrom, $namefrom, $namefrom, $nameto, $subject_reply, $noidung_reply);
		
		//$result = 1;
		
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
	
	*/
	$hoten = $_POST['hoten'];
	$sdt = $_POST['sdt'];
	$email = $_POST['email'];
	$diachi = $_POST['diachi']; 
	$ghichu = $_POST['ghichu'];
	$sanpham = $_POST['sanpham'];
	
	$usersmtp = "hongtien510@ishali.com.vn";
	$passsmtp = "phamhongtien510";
	
	$mailfrom = "hongtien.51090@gmail.com";

	$namefrom = $namereplay = "ISHALI MEDIA";// Ten khi Admin gui mail den KH, va ten KH tra loi mail
	$namefrom_kh = $namereplay_kh = $hoten;// Ten khi KH gui mail den admin
	
	$subject = "Cảm ơn bạn ". $hoten ." đã đặt hàng sản phẩm của Store ISHALI MEDIA";
	$subject_reply = "KH (". $hoten ."-". $sdt .") đã đặt hàng sản phẩm";
	
	
	
	$noidung = "";
	$noidung.="<table width='600' border='1; cellpadding='0' cellspacing='0'>";
	$noidung.="<tr><td height='35' colspan='2'>Cảm ơn bạn <strong>Phạm Hồng Tiến</strong> đã đặt hàng tại Store ISHALI MEDIA.</td></tr>";
	$noidung.="<tr><td height='30' colspan='2'>Thông tin sản phẩm đặt hàng như sau:</td></tr>";
	
	$noidung.="<tr>";
	$noidung.="<td width='317' rowspan='4'>";
	$noidung.="<img src='https://ishalimedia.com/appfb/ishalistore//application/layouts/tmpstore/images/upload/images/1363321551_sm1.jpg' width='300' height='349' /></td>";
	$noidung.="<td height='30' valign='top'><strong>Tên SP</strong> : Áo Sơ Mi Nữ</td></tr>";
	$noidung.="<tr><td height='30' valign='top'><strong>Giá bán</strong> : 100.000 VNĐ</td></tr>";
	$noidung.="<tr><td height='100' valign='top'>Mô tả : ad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad ad</td></tr>";
	$noidung.="<tr><td width='273' height='155' valign='top'><strong>Chi tiết</strong> : ad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad adad asd asd ad ad</td></tr>";
	$noidung.="<tr><td height='30' colspan='2'>&nbsp;</td></tr>";
	
	$noidung.="<tr><td height='250' colspan='2' valign='top'><p><span style='color:#00F; font-weight:bold; font-size:18px'>Thông tin đơn đặt hàng:</span></p>";
	$noidung.="<p>Họ tên : Phạm Hồng Tiến</p>";
	$noidung.="<p>SĐT : 0949968938</p>";
	$noidung.="<p>Email : hongtien510@gmail.com</p>";
	$noidung.="<p>Địa chỉ : 281/39/9 Lê Văn Sỹ, P1, Tân Bình</p>";
	$noidung.="<p>Ghi chú : Gọi điện thoại trước khi giao hàng.</p></td>";
	$noidung.="</tr>";
	$noidung.="<tr><td height='45' colspan='2' valign='top'><p><em>Chúng tôi sẽ liên hệ sớm để xác nhận đơn hàng của bạn.<br/>Cảm ơn bạn đã quan tâm đến sản phẩm của chúng tôi.</em></p></td></tr>";
	$noidung.="</table>";
	
	$noidung_reply = "";
	$noidung_reply.= "<b>Thông Tin Khách Hàng</b><br/>";
	$noidung_reply.= "<b>Họ Tên KH : </b>" . $hoten . ".<br/>";
	$noidung_reply.= "<b>Số Điện Thoại : </b>" . $sdt . ".<br/>";
	$noidung_reply.= "<b>Email : </b>" . $email . ".<br/>";
	$noidung_reply.= "<b>Địa chỉ : </b>" . $diachi . ".<br/>";
	$noidung_reply.= "<b>Ghi chú : </b>" . $ghichu . ".<br/>";
	
	$noidung_reply.= "<b>Thông Tin Đơn Hàng</b><br/>";

	$mailto = $email;
	$nameto = $hoten;
	
	$result = sendmail($usersmtp, $passsmtp, $mailfrom, $mailto, $nameto, $namefrom, $namereplay, $subject, $noidung);
			  sendmail($usersmtp, $passsmtp, $mailto, $mailfrom, $nameto, $namefrom_kh, $namereplay_kh, $subject_reply, $noidung_reply);
	
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
