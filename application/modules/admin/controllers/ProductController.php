<?php

class Admin_ProductController extends App_Controller_AdminController {

    public function init() {
        parent::init();
        $this->_SESSION=new Zend_Session_Namespace();
        
        $facebook = new Ishali_Facebook();
		$idpage = $facebook->getpageid();
        
        if(isset($idpage))
            $_SESSION['idpage'] = $idpage;
    }

    public function indexAction() {
        if(!isset($this->_SESSION->iduseradmin))
		{
			$link_login = APP_DOMAIN."/admin/login";
			header("Location:$link_login");
		}
		$_SESSION['list_page'] = "1";
		
		$store = $this->view->info = App_Models_StoreModel::getInstance();

		
		if($this->_request->getParam("idpage") != "")
        {
			$idpagee = $this->_request->getParam("idpage");
			$_SESSION['idpage'] = $idpagee;
		}
		@$idpage = $_SESSION['idpage'];
		
        
        if($this->_request->getParam("idcat") != "")
        {
            $idcat = $this->_request->getParam("idcat");
            $sql = "Select idsp, masp, tensp, gia, hinhchinh, anhien, showindex ";
            $sql.= "From ishali_sanpham ";
            $sql.= "Where idloaisp = ". $idcat ." and idpage = ".$idpage." ";
            $sql.= "Order by ngaycapnhat desc";
            
            $data = $store->SelectQuery($sql);
            $this->view->product = $data;
        }
        else
        {
            $sql = "Select idsp, masp, tensp, gia, hinhchinh, anhien, showindex ";
            $sql.= "From ishali_sanpham ";
            $sql.= "Where idpage = ". $idpage ." ";
            $sql.= "Order by ngaycapnhat desc";
            
            $data = $store->SelectQuery($sql);
            $this->view->product = $data;
        }
        
        $sql = "Select idloaisp, tenloaisp ";
        $sql.= "From ishali_loaisp ";
        $sql.= "Where anhien = 1 and idpage = ". $idpage ." order by vitri";
        
        
        $data = $store->SelectQuery($sql);
        $this->view->category = $data;
        
		$sql = "select donvitien, thongtinsp from ishali_config where idpage = '". $idpage ."'";
        $data = $store->SelectQuery($sql);
		if($data[0]['donvitien'] == "")
			$donvitien = "VNĐ";
		else
			$donvitien = $data[0]['donvitien'];
        $this->view->donvitien = $donvitien;
		$this->view->thongtinsp = $data[0]['thongtinsp'];

    }
    
    public function addAction() {
        if(!isset($this->_SESSION->iduseradmin))
			header("Location:../login");
		
		$_SESSION['list_page'] = "0";
		
		if($this->_request->getParam("idpage") != "")
        {
			$idpagee = $this->_request->getParam("idpage");
			$_SESSION['idpage'] = $idpagee;
		}
        $idpage = $_SESSION['idpage'];
        
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $sql = "Select idloaisp, tenloaisp ";
        $sql.= "From ishali_loaisp ";
        $sql.= "Where anhien = 1 and idpage = ". $idpage ." order by vitri";
        
		
        $data = $store->SelectQuery($sql);
        $this->view->category = $data;
    }
    
     public function xulyaddAction() {
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $idpage = $_SESSION['idpage'];
        
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
        $sql.= "masp, idloaisp, tensp, gia, hinhchinh, hinhphu, mota, chitietsp, anhien, hethang, baohanh, ngaycapnhat, showindex, titlefb, metafb, idpage ) ";
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
        $sql.= "'".$metafb."', ";
        $sql.= "'".$idpage."')";
        
        echo $data = $store->InsertDeleteUpdateQuery($sql);
    }
    
    
    
    public function detailAction() {
        $idpage = $_SESSION['idpage'];
        
        if(!isset($this->_SESSION->iduseradmin))
			header("Location:../login");
         
		$_SESSION['list_page'] = "0";
		
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        
        $idsp = base64_decode($this->_request->getParam("idsp"));
        $sql = "Select * from ishali_sanpham where idsp = ". $idsp ." and idpage = ". $idpage;
        $data = $store->SelectQuery($sql);
        $this->view->product = $data;
        
        $sql = "Select idloaisp, tenloaisp ";
        $sql.= "From ishali_loaisp ";
        $sql.= "Where anhien = 1 and idpage = ". $idpage ." order by vitri";
        
        $data = $store->SelectQuery($sql);
        $this->view->category = $data;
		
		//Kiem tra co nhap menu ko, ko nhap thi xoa het menu trong ishali_thongtinsp
		$sql = "select menuthongtinsp from ishali_config where idpage = '". $idpage ."'";
		$data = $store->SelectQuery($sql);
		if(count($data)>0)
		{
			if($data[0]['menuthongtinsp'] == "")
			{
				$sql = "Delete from ishali_thongtinsp where idsp = '". $idsp ."'";
				$store->InsertDeleteUpdateQuery($sql);
			}
		}
        
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
	
	public function thongtinsanphamAction(){
		$store = $this->view->info = App_Models_StoreModel::getInstance();
		@$idpage = $_SESSION['idpage'];
		$_SESSION['list_page'] = "0";
		
		$sql = "Select menuthongtinsp from ishali_config where idpage = '". $idpage ."'";
		$data = $store->SelectQuery($sql);
		$menu = $data[0]['menuthongtinsp'];
		$list_menu = explode(";", $menu);
		$this->view->list_menu = $list_menu;
		
		$idsp = @$_GET['idsp'];
		if(@$_GET['keytab']=="")
			$keytab = 1;
		else
			$keytab = @$_GET['keytab'];
		
		$this->view->idsp = $idsp;
		$this->view->keytab = $keytab;
		
		
		$slTab = count($list_menu);
		$sql = "Delete from ishali_thongtinsp where idsp = '". $idsp ."' and keytab > '". $slTab ."'";
		$store->InsertDeleteUpdateQuery($sql);
		
		

		$sql = "select tensp from ishali_sanpham where idsp = '". $idsp ."'";
		$data = $store->SelectQuery($sql);
		$this->view->tensp = $data[0]['tensp'];
		
		$sql = "Select noidung from ishali_thongtinsp where idsp = '". $idsp ."' and keytab = '". $keytab ."'";
		$data = $store->SelectQuery($sql);
		if(count($data) > 0)
			$noidung = $data[0]['noidung'];
		else
			$noidung = "";
		
		$this->view->noidung = $noidung;
		
		
	}
	
	public function thongtinsanphamxulyAction(){
        $store = $this->view->info = App_Models_StoreModel::getInstance();
		
		$idsp = $_POST['idsp'];
		$keytab = $_POST['keytab'];
		$noidung = $_POST['noidung'];
		
		$sql = "Select 1 from ishali_thongtinsp where idsp = '". $idsp ."' and keytab = '". $keytab ."'";
		$data = $store->SelectQuery($sql);
		if(count($data) ==0)
		{
			$sql = "Insert into ishali_thongtinsp(idsp, keytab, noidung) value(";
			$sql.= "'".$idsp."', '".$keytab."', '".$noidung."') ";
		}
		else
		{
			$sql = "Update ishali_thongtinsp set ";
			$sql.= "noidung = N'".$noidung."' ";
			$sql.= "where idsp = '". $idsp ."' and keytab = '". $keytab ."'";
		}
		$data = $store->InsertDeleteUpdateQuery($sql);
		
		if($data == 1)
		{
			echo "<script>ThongBaoDongY('Lưu Thành Công.', '".ROOT_DOMAIN."/admin/product/thongtinsanpham?idsp=".$idsp."&keytab=".$keytab."');</script>";	
		}
		else
		{
			echo "<script>ThongBaoDongY('Lưu không thành công<br/>Vui Lòng thực hiện lại thao tác.', '".ROOT_DOMAIN."/admin/product/thongtinsanpham?idsp=".$idsp."&keytab=".$keytab."');</script>";
		}
		
	}

}








































