<?php

class ProductController extends App_Controller_FrontController {

    public function init() {
        parent::init();
    }

    public function indexAction() {
		$store = $this->view->info = App_Models_StoreModel::getInstance();
        
        $sp = base64_decode($this->_request->getParam("sp"));
        
        $facebook = new Ishali_Facebook();
		$idpage = $facebook->getpageid();
		if(isset($idpage))
            $_SESSION['idpage'] = $idpage;
        else
            $idpage = $_SESSION['idpage'];
		
		//Lay Thong Tin Page
		$fb = $facebook->getFB();
		$pages_fb =  $fb->api('/'.$idpage);
		$linkpage = $pages_fb['link'];
		$this->view->linkpage = $linkpage;
		
        
        
        
        $sql = "Select idsp, masp, idloaisp, tensp, gia, hinhchinh, hinhphu, mota, chitietsp, anhien, baohanh, titlefb, metafb ";
        $sql.= "From ishali_sanpham ";
        $sql.= "Where idsp = " .$sp. " and idpage = ". $idpage;
        //echo $sql;
        $data = $store->SelectQuery($sql);
        $this->view->sanpham = $data;
        
        //San pham lien quan
        $sql = "Select idloaisp from ishali_sanpham where idsp = " . $sp;
        $data = $store->SelectQuery($sql);
        $idloaisp = $data[0]['idloaisp'];
        
        $sql = "Select idsp, idloaisp, masp, tensp, gia, hinhchinh ";
        $sql.= "From ishali_sanpham ";
        $sql.= "Where anhien = 1 and idloaisp = ". $idloaisp ." and idsp != ". $sp . " and idpage = '". $idpage ."' ";
        $sql.= "Order by rand() limit 0,4";
        
        //echo $sql;
        
        $data = $store->SelectQuery($sql);
        $this->view->splienquan = $data;
		
		$sql = "select donvitien from ishali_config where idpage = '". $idpage ."'";
        $data = $store->SelectQuery($sql);
		if($data[0]['donvitien'] == "")
			$donvitien = "VNĐ";
		else
			$donvitien = $data[0]['donvitien'];
        $this->view->donvitien = $donvitien;

    }
    
    

   

}
