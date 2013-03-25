<?php

class Admin_ProductController extends App_Controller_AdminController {

    public function init() {
        parent::init();
        $this->_SESSION=new Zend_Session_Namespace();
    }

    public function indexAction() {
        if(!isset($this->_SESSION->iduseradmin))
			header("Location:login");
            
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        
        if($this->_request->getParam("idcat") != "")
        {
            
            $idcat = $this->_request->getParam("idcat");
            $sql = "Select idsp, masp, tensp, gia, hinhchinh, anhien, showindex ";
            $sql.= "From ishali_sanpham ";
            $sql.= "Where idloaisp = ". $idcat. " ";
            $sql.= "Order by ngaycapnhat desc";
            
            $data = $store->SelectQuery($sql);
            $this->view->product = $data;
        }
        else
        {
            $sql = "Select idsp, masp, tensp, gia, hinhchinh, anhien, showindex ";
            $sql.= "From ishali_sanpham ";
            $sql.= "Order by ngaycapnhat desc";
            
            $data = $store->SelectQuery($sql);
            $this->view->product = $data;
        }
        
        $sql = "Select idloaisp, tenloaisp ";
        $sql.= "From ishali_loaisp ";
        $sql.= "Where anhien = 1 order by vitri";
        
        $data = $store->SelectQuery($sql);
        $this->view->category = $data;
        
        
        
        
    }
    
    public function addAction() {
        if(!isset($this->_SESSION->iduseradmin))
			header("Location:../login");
            
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $sql = "Select idloaisp, tenloaisp ";
        $sql.= "From ishali_loaisp ";
        $sql.= "Where anhien = 1 order by vitri";
        
        $data = $store->SelectQuery($sql);
        $this->view->category = $data;
    }
    
     public function xulyaddAction() {
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        //masp, tensp, thuocloaisp, giaban ,string_img_upload, string_img_upload_ch, mota, chitiet, hethang, hienthi, titlefb, metafb
        
        $masp = $_POST['masp'];
        $tensp = $_POST['tensp'];
        $thuocloaisp = $_POST['thuocloaisp'];
        $giaban = $_POST['giaban'];
        $hinhchinh = $_POST['string_img_upload'];
        $hinhphu = $_POST['string_img_upload_ch'];
        $mota = $_POST['mota'];
        $chitiet = $_POST['chitiet'];
        $hethang = $_POST['hethang'];
        $anhien = $_POST['anhien'];
        $showindex = $_POST['showindex'];
        $titlefb = $_POST['titlefb'];
        $metafb = $_POST['metafb'];
        
        $arrhinhchinh = explode(",",$hinhchinh);
        //print_r($arrhinhchinh);
        $str_hinhchinh = "";
        $dem=0;
        for($i=0; $i<count($arrhinhchinh); $i++)
        {
            if($arrhinhchinh[$i]!="" and $str_hinhchinh == "")
            {
                $str_hinhchinh .= $arrhinhchinh[$i];
                $dem++;
            }
            else
            {
                if($arrhinhchinh[$i]!="" and $str_hinhchinh != "")
                {
                    $str_hinhchinh .= ',' . $arrhinhchinh[$i];
                    $dem++;
                }
            }
            if($dem==1)
                break;    
            
        }
        
        
        $arrhinhphu = explode(",",$hinhphu);
        //print_r($arrhinhphu);
        $str_hinhphu = "";
        $dem=0;
        for($i=0; $i<count($arrhinhphu); $i++)
        {
            if($arrhinhphu[$i]!="" and $str_hinhphu == "")
            {
                $str_hinhphu .= $arrhinhphu[$i];
                $dem++;
            }
            else
            {
                if($arrhinhphu[$i]!="" and $str_hinhphu != "")
                {
                    $str_hinhphu .= ',' . $arrhinhphu[$i];
                    $dem++;
                }
            }
            if($dem==4)
                break;
            
            
        }
       
        
        
        
        $sql = "Insert into ishali_sanpham (";
        $sql.= "masp, idloaisp, tensp, gia, hinhchinh, hinhphu, mota, chitietsp, anhien, hethang, baohanh, ngaycapnhat, showindex, titlefb, metafb ) ";
        $sql.= "values (";
        $sql.= "'".$masp."', ";
        $sql.= "'".$thuocloaisp."', ";
        $sql.= "N'".$tensp."', ";
        $sql.= "'".$giaban."', ";
        $sql.= "'".$str_hinhchinh."', ";
        $sql.= "'".$str_hinhphu."', ";
        $sql.= "N'".$mota."', ";
        $sql.= "N'".$chitiet."', ";
        $sql.= "'".$anhien."', ";
        $sql.= "'".$hethang."', ";
        $sql.= "'0', ";
        $sql.= "now(), ";
        $sql.= "'".$showindex."', ";
        $sql.= "'".$titlefb."', ";
        $sql.= "'".$metafb."')";
        
        echo $data = $store->InsertDeleteUpdateQuery($sql);
    }
    
    
    
    public function detailAction() {
        if(!isset($this->_SESSION->iduseradmin))
			header("Location:../login");
            
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        
        echo $idsp = base64_decode($this->_request->getParam("idsp"));
        $sql = "Select * from ishali_sanpham where idsp = " . $idsp;
        $data = $store->SelectQuery($sql);
        $this->view->product = $data;
        
        $sql = "Select idloaisp, tenloaisp ";
        $sql.= "From ishali_loaisp ";
        $sql.= "Where anhien = 1 order by vitri";
        
        $data = $store->SelectQuery($sql);
        $this->view->category = $data;
        
    }
    
    public function xulyupdateAction() {
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        //masp, tensp, thuocloaisp, giaban ,string_img_upload, string_img_upload_ch, mota, chitiet, hethang, hienthi, titlefb, metafb
        
        $idsp = $_POST['idsp'];
        $masp = $_POST['masp'];
        $tensp = $_POST['tensp'];
        $thuocloaisp = $_POST['thuocloaisp'];
        $giaban = $_POST['giaban'];
        
        $mota = $_POST['mota'];
        $chitiet = $_POST['chitiet'];
        $hethang = $_POST['hethang'];
        $anhien = $_POST['anhien'];
        $showindex = $_POST['showindex'];
        $titlefb = $_POST['titlefb'];
        $metafb = $_POST['metafb'];
        
        $hinhchinh = $_POST['string_img_upload'];
        $hinhphu = $_POST['string_img_upload_ch'];
        
        if($hinhchinh!="")
        {
            $sql = "Select hinhchinh from ishali_sanpham where idsp = " . $idsp;
            $data = $store->SelectQuery($sql);
            $hinhchinh_old = $data[0]['hinhchinh'];
           

            if(file_exists('application/layouts/tmpstore/images/upload/images/'.$hinhchinh_old))
            {
                unlink('application/layouts/tmpstore/images/upload/images/'.$hinhchinh_old);
            }

            $arrhinhchinh = explode(",",$hinhchinh);
        
            $str_hinhchinh = "";
            $dem=0;
            for($i=0; $i<count($arrhinhchinh); $i++)
            {
                if($arrhinhchinh[$i]!="" and $str_hinhchinh == "")
                {
                    $str_hinhchinh .= $arrhinhchinh[$i];
                    $dem++;
                }
                else
                {
                    if($arrhinhchinh[$i]!="" and $str_hinhchinh != "")
                    {
                        $str_hinhchinh .= ',' . $arrhinhchinh[$i];
                        $dem++;
                    }
                }
                if($dem==1)
                    break;    
                
            }
        }
        
        if($hinhphu!="")
        {
            $sql = "Select hinhphu from ishali_sanpham where idsp = " . $idsp;
            $data = $store->SelectQuery($sql);
            $arr_hinhphu = $data[0]['hinhphu'];
            
            $hinhphu_old = explode(",", $arr_hinhphu);
            for($i=0; $i<count($hinhphu_old); $i++)
            {
                if(file_exists('application/layouts/tmpstore/images/upload/images/'.$hinhphu_old[$i]))
                {
                    unlink('application/layouts/tmpstore/images/upload/images/'.$hinhphu_old[$i]);
                }
            }
            
           

            
            
            $arrhinhphu = explode(",",$hinhphu);
            
            $str_hinhphu = "";
            $dem=0;
            for($i=0; $i<count($arrhinhphu); $i++)
            {
                if($arrhinhphu[$i]!="" and $str_hinhphu == "")
                {
                    $str_hinhphu .= $arrhinhphu[$i];
                    $dem++;
                }
                else
                {
                    if($arrhinhphu[$i]!="" and $str_hinhphu != "")
                    {
                        $str_hinhphu .= ',' . $arrhinhphu[$i];
                        $dem++;
                    }
                }
                if($dem==4)
                    break; 
            }
        }
        
        if($hinhchinh == "" && $hinhphu =="")
        {
            $sql = "Update ishali_sanpham set ";
            $sql.= "masp = '" . $masp . "', ";
            $sql.= "idloaisp = '" . $thuocloaisp . "', ";
            $sql.= "tensp = N'" . $tensp . "', ";
            $sql.= "gia = '" . $giaban . "', ";
            $sql.= "mota = N'" . $mota . "', ";
            $sql.= "chitietsp = N'" . $chitiet . "', ";
            $sql.= "anhien = '" . $anhien . "', ";
            $sql.= "hethang = '" . $hethang . "', ";
            $sql.= "ngaycapnhat = now(), ";
            $sql.= "showindex = '" . $showindex . "', ";
            $sql.= "titlefb = '" . $titlefb . "', ";
            $sql.= "metafb = '" . $metafb . "' ";
            $sql.= "Where idsp = '" . $idsp . "'";
            
        }
        
        if($hinhchinh != "" && $hinhphu =="")
        {
            $sql = "Update ishali_sanpham set ";
            $sql.= "masp = '" . $masp . "', ";
            $sql.= "idloaisp = '" . $thuocloaisp . "', ";
            $sql.= "tensp = N'" . $tensp . "', ";
            $sql.= "gia = '" . $giaban . "', ";
            $sql.= "hinhchinh = '" . $str_hinhchinh . "', ";
            $sql.= "mota = N'" . $mota . "', ";
            $sql.= "chitietsp = N'" . $chitiet . "', ";
            $sql.= "anhien = '" . $anhien . "', ";
            $sql.= "hethang = '" . $hethang . "', ";
            $sql.= "ngaycapnhat = now(), ";
            $sql.= "showindex = '" . $showindex . "', ";
            $sql.= "titlefb = '" . $titlefb . "', ";
            $sql.= "metafb = '" . $metafb . "' ";
            $sql.= "Where idsp = '" . $idsp . "'";
            
        }
        
        if($hinhchinh == "" && $hinhphu !="")
        {
            $sql = "Update ishali_sanpham set ";
            $sql.= "masp = '" . $masp . "', ";
            $sql.= "idloaisp = '" . $thuocloaisp . "', ";
            $sql.= "tensp = N'" . $tensp . "', ";
            $sql.= "gia = '" . $giaban . "', ";
            $sql.= "hinhphu = '" . $str_hinhphu . "', ";
            $sql.= "mota = N'" . $mota . "', ";
            $sql.= "chitietsp = N'" . $chitiet . "', ";
            $sql.= "anhien = '" . $anhien . "', ";
            $sql.= "hethang = '" . $hethang . "', ";
            $sql.= "ngaycapnhat = now(), ";
            $sql.= "showindex = '" . $showindex . "', ";
            $sql.= "titlefb = '" . $titlefb . "', ";
            $sql.= "metafb = '" . $metafb . "' ";
            $sql.= "Where idsp = '" . $idsp . "'";
           
        }
        
        if($hinhchinh != "" && $hinhphu !="")
        {
            $sql = "Update ishali_sanpham set ";
            $sql.= "masp = '" . $masp . "', ";
            $sql.= "idloaisp = '" . $thuocloaisp . "', ";
            $sql.= "tensp = N'" . $tensp . "', ";
            $sql.= "gia = '" . $giaban . "', ";
            $sql.= "hinhchinh = '" . $str_hinhchinh . "', ";
            $sql.= "hinhphu = '" . $str_hinhphu . "', ";
            $sql.= "mota = N'" . $mota . "', ";
            $sql.= "chitietsp = N'" . $chitiet . "', ";
            $sql.= "anhien = '" . $anhien . "', ";
            $sql.= "hethang = '" . $hethang . "', ";
            $sql.= "ngaycapnhat = now(), ";
            $sql.= "showindex = '" . $showindex . "', ";
            $sql.= "titlefb = '" . $titlefb . "', ";
            $sql.= "metafb = '" . $metafb . "' ";
            $sql.= "Where idsp = '" . $idsp . "'";
            
        }
       
        //echo $sql;
        echo $data = $store->InsertDeleteUpdateQuery($sql);
    }
    
    public function xulydeleteAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $idsp = $_POST['idsp'];
        
        

        $sql = "Select hinhchinh, hinhphu from ishali_sanpham where idsp = " . $idsp;
        $data = $store->SelectQuery($sql);
        
        $hinhchinh = $data[0]['hinhchinh'];
        $arr_hinhphu = $data[0]['hinhphu'];
        
        

        if(file_exists('application/layouts/tmpstore/images/upload/images/'.$hinhchinh))
        {
            unlink('application/layouts/tmpstore/images/upload/images/'.$hinhchinh);
        }

            
        $hinhphu = explode(",", $arr_hinhphu);
        for($i=0; $i<count($hinhphu); $i++)
        {
            if(file_exists('application/layouts/tmpstore/images/upload/images/'.$hinhphu[$i]))
            {
                unlink('application/layouts/tmpstore/images/upload/images/'.$hinhphu[$i]);
            }
        }

        
        
        $sql = "Delete from ishali_sanpham where idsp = " . $idsp;
        $data = $store->InsertDeleteUpdateQuery($sql);
        echo $data;
        
    }

}








































