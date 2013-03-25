<?php
class CategoryController extends App_Controller_FrontController {

    public function init() {
        parent::init();
    }

    public function indexAction() {
		$store = $this->view->info = App_Models_StoreModel::getInstance();
        
		$id = base64_decode($this->_request->getParam("id"));
        
        $sql = "select count(*) as tongsp ";
        $sql.= "from ishali_sanpham ";
        $sql.= "where anhien = 1 and idloaisp = ". $id;
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
                $sql.= "where anhien = 1 and idloaisp = " . $id. " order by ngaycapnhat desc ";
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
                $sql.= "where anhien = 1 and idloaisp = " . $id. " order by ngaycapnhat desc ";
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
            $sql.= "where anhien = 1 and idloaisp = " . $id. " order by ngaycapnhat desc ";
            $sql.= "limit 0,". $sp1trang;

            $data = $store->SelectQuery($sql);
            $this->view->showsp = $data;
        }
        
        
        
        
        
        
        
        
        
        
        
        
    }
    
    

   

}
