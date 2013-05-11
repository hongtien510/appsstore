<?php

class IndexController extends App_Controller_FrontController {

    public function init() {
        parent::init();
        
        $facebook = new Ishali_Facebook();
		$idpage = $facebook->getpageid();
		
        if(isset($idpage))
            $_SESSION['idpage'] = $idpage;
    }

    public function indexAction() {
		$store = $this->view->info = App_Models_StoreModel::getInstance();
		
        $facebook = new Ishali_Facebook();
		if($facebook->getParameterUrl()!=null)
		{
			$param = $facebook->getParameterUrl();
			$data = explode( '-', $param );
			$id = $data[0];
			$sp = $data[1];
			$host = APP_DOMAIN;

			header("location: $host/product?id=$id&sp=$sp");
			//http://localhost/appfb/ishalistore/product?id=Mg==&sp=MTg=
		}


        $idpage = $_SESSION['idpage'];


        $sql = "select count(*) as tongsp ";
        $sql.= "from ishali_sanpham ";
        $sql.= "where anhien = 1 and showindex=1 and idpage = ". $idpage;
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
                $sql.= "where showindex = 1 and anhien = 1 and idpage = ". $idpage ." order by ngaycapnhat desc ";
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
                $sql.= "where showindex = 1 and anhien = 1 and idpage = ". $idpage ." order by ngaycapnhat desc ";
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
            $sql.= "where (showindex = 1 || ngaycapnhat < now()) and anhien = 1 and idpage = ". $idpage ." order by ngaycapnhat desc ";
            $sql.= "limit 0,12";

            $data = $store->SelectQuery($sql);
            $this->view->showsp = $data;
        }
        
    }
    
    

   

}
