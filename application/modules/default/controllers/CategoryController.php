<?php
class CategoryController extends App_Controller_FrontController {

    public function init() {
        parent::init();
    }

    public function indexAction() {
		$store = $this->view->info = App_Models_StoreModel::getInstance();
        
		$id = base64_decode($this->_request->getParam("id"));

        //$idpage = '356730004423499';
		if(isset($_SESSION['idpage']) && $_SESSION['idpage'] != "")
		{
			$idpage = $_SESSION['idpage'];
			$this->view->idpage = $idpage;
		}
		else
		{
			//$idpage = $_GET["idpage"];
			$idpage = $this->_request->getParam("idpage");
			$this->view->idpage = $idpage;
		}
        $sql = "select count(*) as tongsp ";
        $sql.= "from ishali_sanpham ";
        $sql.= "where anhien = 1 and idloaisp = ". $id ." and idpage = ". $idpage;
        $data = $store->SelectQuery($sql);
        $tongsp = $data[0]['tongsp'];
        $sp1trang = 12;
        
        if($tongsp>$sp1trang)
        {
            $sotrang = ceil($tongsp/$sp1trang);
            if($this->_request->getParam("page")=="")
            {
                $sql = "Select idsp, masp, idloaisp, tensp, gia, hinhchinh ";
                $sql.= "from ishali_sanpham ";
                $sql.= "where anhien = 1 and idloaisp = " . $id. " and idpage = ". $idpage ." order by ngaycapnhat desc ";
                $sql.= "limit 0,". $sp1trang;
                
                $data = $store->SelectQuery($sql);
                $this->view->showsp = $data;
                
            }
            else
            {
                $npage = base64_decode($this->_request->getParam("page"));
                $sp_start = ($sp1trang*($npage-1));
                
                $sql = "Select idsp, masp, idloaisp, tensp, gia, hinhchinh ";
                $sql.= "from ishali_sanpham ";
                $sql.= "where anhien = 1 and idloaisp = " . $id. " and idpage = ". $idpage ." order by ngaycapnhat desc ";
                $sql.= "limit ". $sp_start .",". $sp1trang;
                
                $data = $store->SelectQuery($sql);
                $this->view->showsp = $data;
            }

            $this->view->sotrang = $sotrang;
        }
        else
        {
            $sql = "Select idsp, masp, idloaisp, tensp, gia, hinhchinh ";
            $sql.= "from ishali_sanpham ";
            $sql.= "where anhien = 1 and idloaisp = " . $id. " and idpage = ". $idpage ." order by ngaycapnhat desc ";
            $sql.= "limit 0,". $sp1trang;

            $data = $store->SelectQuery($sql);
            $this->view->showsp = $data;
        }
    }

}
