<?php

class ProductController extends App_Controller_FrontController {

    public function init() {
        parent::init();
    }

    public function indexAction() {
		$store = $this->view->info = App_Models_StoreModel::getInstance();
        
        $sp = base64_decode($this->_request->getParam("sp"));
        
        //echo $sp;
        $sql = "Select idsp, masp, idloaisp, tensp, gia, hinhchinh, hinhphu, mota, chitietsp, anhien, baohanh ";
        $sql.= "From ishali_sanpham ";
        $sql.= "Where idsp = " . $sp;
        //echo $sql;
        $data = $store->SelectQuery($sql);
        $this->view->sanpham = $data;
        
        //San pham lien quan
        $sql = "Select idloaisp from ishali_sanpham where idsp = " . $sp;
        $data = $store->SelectQuery($sql);
        $idloaisp = $data[0]['idloaisp'];
        
        $sql = "Select idsp, idloaisp, masp, tensp, gia, hinhchinh ";
        $sql.= "From ishali_sanpham ";
        $sql.= "Where anhien = 1 and idloaisp = ". $idloaisp ." and idsp != ". $sp . " ";
        $sql.= "Order by rand() limit 0,4";
        
        //echo $sql;
        
        $data = $store->SelectQuery($sql);
        $this->view->splienquan = $data;

    }
    
    

   

}
