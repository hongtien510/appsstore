<?php

class Admin_CategoryController extends App_Controller_AdminController {

    public function init() {
        parent::init();
        $this->_SESSION=new Zend_Session_Namespace();
        
        $facebook = new Ishali_Facebook();
		$idpage = $facebook->getpageid();
        
        if(isset($idpage))
            $_SESSION['idpage'] = $idpage;
            
    }

    public function indexAction() {
		$store = $this->view->info = App_Models_StoreModel::getInstance();
        if(!isset($this->_SESSION->iduseradmin))
		{
			$link_login = APP_DOMAIN."/admin/login";
			header("Location:$link_login");
		}
		$_SESSION['list_page'] = "1";
		
		if($this->_request->getParam("idpage") != "")
        {
			$idpagee = $this->_request->getParam("idpage");
			$_SESSION['idpage'] = $idpagee;
		}
		@$idpage = $_SESSION['idpage'];
        
		$checkSessionIdpage = $store->KiemTraSessionIdPage($idpage);
		if($checkSessionIdpage == 0)
		{
			$this->view->checkSessionIdpage = $checkSessionIdpage;
		}
		else
		{
			$sql = "Select * from ishali_loaisp where idpage = ". $idpage ."  order by vitri";
			$data = $store->SelectQuery($sql);
			$this->view->category = $data;
			
			$this->view->checkSessionIdpage = $checkSessionIdpage;
		}	
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
        $sql = "select max(vitri) as 'maxvitri' from ishali_loaisp where idpage = ". $idpage;
		$data = $store->SelectQuery($sql);
        $this->view->maxvitri = $data[0]['maxvitri'];
    }
    
    public function detailAction() {
        if(!isset($this->_SESSION->iduseradmin))
			header("Location:../login");
        
		$_SESSION['list_page'] = "0";
		
        $idpage = $_SESSION['idpage'];
        
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $idcat = base64_decode($this->_request->getParam("idcat"));
        $sql = "Select * from ishali_loaisp where idloaisp = " . $idcat . " and idpage = ". $idpage;
        $data = $store->SelectQuery($sql);
        $this->view->category = $data;

    }
	
	public function xulyaddAction() {    
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $idpage = $_SESSION['idpage'];
        
        $Tenlsp = $_POST["tenlsp"];
        $Vitri = $_POST["vitri"];
        $Anhien = $_POST["anhien"];

        $store = $this->view->info = App_Models_StoreModel::getInstance();
        
        $sql = "Insert into ishali_loaisp(tenloaisp, vitri, anhien, idpage) ";
        $sql.= "Values ('" . $Tenlsp . "', '" . $Vitri . "', '" . $Anhien . "', '". $idpage ."')";
        
        //echo $sql;
		echo $data = $store->InsertDeleteUpdateQuery($sql);
		
    }
    
    public function xulyupdateAction() {    
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $idCategory = $_POST['idcategory'];
        $Tenlsp = $_POST["tenlsp"];
        $Vitri = $_POST["vitri"];
        $Anhien = $_POST["anhien"];
        
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        
        $sql = "Update ishali_loaisp Set ";
        $sql.= "tenloaisp = N'" . $Tenlsp . "', ";
        $sql.= "vitri = '" . $Vitri . "', ";
        $sql.= "anhien = '" . $Anhien . "' ";
        $sql.= "where idloaisp = ". $idCategory;

        
        //echo $sql;
		echo $data = $store->InsertDeleteUpdateQuery($sql);
		
    }
    
   	public function deleteAction() {           
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $idcat = base64_decode($this->_request->getParam("idcat"));
        
        $sql = "Delete from ishali_loaisp where idloaisp = " . $idcat;
        $data = $store->InsertDeleteUpdateQuery($sql);
        header("location: ../category");
    }

}

