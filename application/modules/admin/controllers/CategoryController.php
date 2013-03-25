<?php

class Admin_CategoryController extends App_Controller_AdminController {

    public function init() {
        parent::init();
        $this->_SESSION=new Zend_Session_Namespace();
    }

    public function indexAction() {
        if(!isset($this->_SESSION->iduseradmin))
			header("Location:login");
            
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $sql = "Select * from ishali_loaisp order by vitri";
        $data = $store->SelectQuery($sql);
        $this->view->category = $data;
    }
	
	public function addAction() {
        if(!isset($this->_SESSION->iduseradmin))
			header("Location:../login");
            
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $sql = "select max(vitri) as 'maxvitri' from ishali_loaisp";
		$data = $store->SelectQuery($sql);
        $this->view->maxvitri = $data[0]['maxvitri'];
    }
    
    public function detailAction() {
        if(!isset($this->_SESSION->iduseradmin))
			header("Location:../login");
            
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        $idcat = base64_decode($this->_request->getParam("idcat"));
        $sql = "Select * from ishali_loaisp where idloaisp = " . $idcat;
        $data = $store->SelectQuery($sql);
        $this->view->category = $data;

    }
	
	public function xulyaddAction() {    
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $Tenlsp = $_POST["tenlsp"];
        $Vitri = $_POST["vitri"];
        $Anhien = $_POST["anhien"];

        $store = $this->view->info = App_Models_StoreModel::getInstance();
        
        $sql = "Insert into ishali_loaisp(tenloaisp, vitri, anhien) ";
        $sql.= "Values ('" . $Tenlsp . "', '" . $Vitri . "', '" . $Anhien . "')";
        
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

