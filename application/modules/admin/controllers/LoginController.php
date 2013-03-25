<?php

class Admin_LoginController extends App_Controller_AdminController {

    public function init() {
        parent::init();
        $this->_SESSION=new Zend_Session_Namespace();
        
    }

    public function indexAction() {
        
    }
    
    public function xulyloginAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $store = $this->view->info = App_Models_StoreModel::getInstance();
        
        $user = $_POST['user'];
        $pass = sha1($_POST['pass']);

        $sql = "Select iduser, hoten From ishali_admin where user = '".$user."' and pass = '".$pass."'";
        $data = $store->SelectQuery($sql);

        if(count($data)==1)
        {
            echo '1';
            $this->_SESSION->iduseradmin=$data[0]["iduser"];
            $this->_SESSION->hotenadmin=$data[0]["hoten"];
            
        }
        else
            echo '0';
    }
    
    public function dangxuatAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
        unset ($this->_SESSION->iduseradmin);
        unset ($this->_SESSION->hotenadmin);
        header("location: ../login");
    }
    
}








































