<?php

class ProductController extends App_Controller_FrontController {

    public function init() {
        parent::init();
    }

    public function indexAction() {
		$store = $this->view->info = App_Models_StoreModel::getInstance();
        
        $sp = base64_decode($this->_request->getParam("sp"));

		
        //$idpage = $_SESSION['idpage'];
		//$idpage = $this->_request->getParam("idpage");
		//$this->view->idpage = $idpage;
		if(isset($_SESSION['idpage']) && $_SESSION['idpage'] != "")
		{
			$idpage = $_SESSION['idpage'];
			$this->view->idpage = $idpage;
		}
		else
		{
			//$idpage = $_GET["idpage"];
			$idpage = $this->_request->getParam("idpage");
			echo $this->view->idpage = $idpage;
		}
		

		$linkpage = $store->getLinkPage($idpage);
		$this->view->linkpage = $linkpage;
		
        $sql = "Select idsp, masp, idloaisp, tensp, gia, hinhchinh, hinhphu, mota, chitietsp, anhien, baohanh, titlefb, metafb ";
        $sql.= "From ishali_sanpham ";
        $sql.= "Where idsp = " .$sp. " and idpage = ". $idpage;
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
		
		$sql = "select donvitien, thongtinsp, menuthongtinsp, link_page from ishali_config where idpage = '". $idpage ."'";
		$data = $store->SelectQuery($sql);
		
	//Thay doi don vi tien
		if($data[0]['donvitien'] == "")
			$donvitien = "VNĐ";
		else
			$donvitien = $data[0]['donvitien'];
        $this->view->donvitien = $donvitien;
		
	//Link Page de gan vao Plugin Like
		if($data[0]['link_page'] != "")
			$this->view->link_page = $data[0]['link_page'];
		else
			$this->view->link_page = 'http://www.facebook.com/AgencySocialMediaMarketing';
		
	//KT xem co tuy chon mo tab menu thong tin san pham
		if($data[0]['thongtinsp']==1)
		{
			$menu = $data[0]['menuthongtinsp'];
			$list_menu = explode(";", $menu);
			$this->view->list_menu = $list_menu;
			

			for($i=0; $i<count($list_menu); $i++)
			{
				$sql = "select noidung from ishali_thongtinsp where idsp = '". $sp ."' and keytab = '". ($i+1) ."'";
				$data = $store->SelectQuery($sql);
				if(count($data) > 0)
				{
					$noidung[$i] = $data[0]['noidung'];
				}
				else
				{
					$noidung[$i] = "";
				}
			}
			$this->view->noidung = $noidung;
			
		}
		else
		{
			$this->view->list_menu = "";
		}
		
		
		

    }
    public function thongtinsanphamxulyAction() {
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		$store = $this->view->info = App_Models_StoreModel::getInstance();
		
		$idsp = $_POST['idsp'];
		$idtab = $_POST['idtab'];
		
		
		$sql = "Select noidung from ishali_thongtinsp where idsp = '". $idsp ."' and keytab = '". $idtab ."'";
		$data = $store->SelectQuery($sql);
		if(count($data)>0)
			$noidung = $data[0]['noidung'];
		else
			$noidung ="";
		
		echo $noidung;
		
	}
    

   

}
