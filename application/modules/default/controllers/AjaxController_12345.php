<?php

class AjaxController extends App_Controller_FrontController {

    public function init() {
        parent::init();
		$facebook = new Ishali_Facebook();
		$idpage = $facebook->getpageid();
        if(isset($idpage))
            $_SESSION['idpage'] = $idpage;
    }

    public function indexAction() {
	
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
		$store = $this->view->info = App_Models_StoreModel::getInstance();
        include "sendmail.php";
		
		@$idpage = $_SESSION['idpage'];
		$sql = "Select * from ishali_config where idpage = '". $idpage ."'";
		$config = $store->SelectQuery($sql);


		$hoten = $_POST['hoten'];
		$sdt = $_POST['sdt'];
		$email = $_POST['email'];
		$diachi = $_POST['diachi']; 
		$ghichu = $_POST['ghichu'];
		$sanpham = $_POST['sanpham'];
		
		
		if($config[0]['emailsmtp'] != "") 
			$usersmtp = $config[0]['emailsmtp']; 
		else		
			$usersmtp = "hongtien510@ishali.com.vn";
			
		
		if($config[0]['passsmtp'] != "") 
			$passsmtp = $config[0]['passsmtp']; 
		else 
			$passsmtp = "phamhongtien510";

		
		
		if($config[0]['emailfrom'] != "") 
			$mailfrom = $config[0]['emailfrom']; 
		else 
			$mailfrom = "hongtien510@gmail.com";
		
		
		if($config[0]['title_from'] != "") 
			$namefrom = $namereplay = $config[0]['title_from']; 
		else 
			$namefrom = $namereplay = "ISHALI MEDIA";// Ten khi Admin gui mail den KH, va ten KH tra loi mail
		
		
		$namefrom_kh = $namereplay_kh = $hoten;// Ten khi KH gui mail den admin
		
		$subject_bk = "Cảm ơn bạn ". $hoten ." đã đặt hàng sản phẩm của Store ISHALI MEDIA";
		
		if($config[0]['subject_from'] != "") 
			$subject =  $config[0]['subject_from']; 
		else  
			$subject = $subject_bk;

			
		$subject_reply = "KH (". $hoten ."-". $sdt .") đã đặt hàng sản phẩm";

		$sql = "Select idsp, masp, tensp, gia, hinhchinh, mota, chitietsp ";
		$sql.= "From ishali_sanpham ";
		$sql.= "Where idsp = ". $sanpham;
		
		$data = $store->SelectQuery($sql);
		
		//APP_DOMAIN - http://ishalimedia.com/appfb/ishalistore
		$linkanh = APP_DOMAIN. "/application/layouts/tmpstore/images/upload/images/". $data[0]['hinhchinh'];
		
		
		$noidung = "";
		$noidung.="<table width='600' border='0' cellpadding='0' cellspacing='0'>";
		$noidung.="<tr><td height='35' colspan='2'>Xin chào bạn <strong>". $hoten ."</strong>.</td></tr>";
		$noidung.="<tr><td height='30' colspan='2'>Thông tin sản phẩm đặt hàng như sau:</td></tr>";
		
		$noidung.="<tr>";
		$noidung.="<td width='317' rowspan='4'>";
		$noidung.="<img src='". $linkanh ."' width='300' height='350' /></td>";
		$noidung.="<td height='30' valign='top'><strong>Tên SP</strong> : ". $data[0]['tensp'] ."</td></tr>";
		$noidung.="<tr><td height='30' valign='top'><strong>Giá bán</strong> : ". $data[0]['gia'] ." VNĐ</td></tr>";
		$noidung.="<tr><td height='100' valign='top'><strong>Mô tả</strong> : ". $data[0]['mota'] ."</td></tr>";
		$noidung.="<tr><td width='273' height='155' valign='top'><strong>Chi tiết</strong> : ". $data[0]['chitietsp'] ."</td></tr>";
		$noidung.="<tr><td height='30' colspan='2'>&nbsp;</td></tr>";
		
		$noidung.="<tr><td height='200' colspan='2' valign='top'><p><span style='color:#00F; font-weight:bold; font-size:18px'>Thông tin đơn đặt hàng:</span></p>";
		$noidung.="<p>Họ tên : ". $hoten ."</p>";
		$noidung.="<p>SĐT : ". $sdt ."</p>";
		$noidung.="<p>Email : ". $email ."</p>";
		$noidung.="<p>Địa chỉ : ". $diachi ."</p>";
		$noidung.="<p>Ghi chú : ". $ghichu ."</p></td>";
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
		
		$noidung_reply.= "<b>Thông Tin Đơn Hàng</b><br/><br/>";
		
		$noidung_reply.="<table width='600' border='0' cellpadding='0' cellspacing='0'>";
		$noidung_reply.="<tr>";
		$noidung_reply.="<td width='317' rowspan='4'>";
		$noidung_reply.="<img src='". $linkanh ."' width='300' height='350' /></td>";
		$noidung_reply.="<td height='30' valign='top'><strong>Tên SP</strong> : ". $data[0]['tensp'] ."</td></tr>";
		$noidung_reply.="<tr><td height='30' valign='top'><strong>Giá bán</strong> : ". $data[0]['gia'] ." VNĐ</td></tr>";
		$noidung_reply.="<tr><td height='100' valign='top'><strong>Mô tả</strong> : ". $data[0]['mota'] ."</td></tr>";
		$noidung_reply.="<tr><td width='273' height='155' valign='top'><strong>Chi tiết</strong> : ". $data[0]['chitietsp'] ."</td></tr>";
		$noidung_reply.="<tr><td height='30' colspan='2'>&nbsp;</td></tr>";
		$noidung_reply.="</table>";
		
		

		$mailto = $email;
		$nameto = $hoten;
		
		$result = sendmail($usersmtp, $passsmtp, $mailfrom, $mailto, $nameto, $namefrom, $namereplay, $subject, $noidung);
				  sendmail($usersmtp, $passsmtp, $mailto, $mailfrom, $nameto, $namefrom_kh, $namereplay_kh, $subject_reply, $noidung_reply);
		
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
		
		
	
    }
    
    

   

}
