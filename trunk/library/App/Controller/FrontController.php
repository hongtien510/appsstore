<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FrontController
 *
 * @author root
 */
class App_Controller_FrontController extends Zend_Controller_Action {

    public function init() {
		//$option = array('layout' => 'layout', 'layoutPath' => LAYOUT_PATH . '/' . $page->templates);
		//Duong dan den layout
        $option = array('layout' => 'layout', 'layoutPath' => LAYOUT_PATH . '/tmpstore');
        Zend_Layout::startMvc($option);
        
    }

    public function preDispatch() {
	
        $facebook = new Ishali_Facebook();
	
		//$facebook->begins_works(0);
        //$this->view->id_userr = $facebook->getuserfbid();
		//$this->view->id_fb_page = $facebook->getpageid();
		
		
        $facebook->getuserfbid();
		if($facebook->getpageid() != "")
		{
			@$idpage = $facebook->getpageid();
			@$_SESSION['idpage'] = $idpage;
		}
		else
		{
			@$idpage = $_SESSION['idpage'];
		}
    }

    public function postDispatch() {
        
    }

}

