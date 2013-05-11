<?php
//$this->_SESSION=new Zend_Session_Namespace();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BangmauModel
 *
 * @author root
 */
class App_Models_StoreModel {

    private $_db;
    private static $_instance;

    public static function getInstance() {
        if (self::$_instance == NULL) {
            self::$_instance = new App_Models_StoreModel();
            self::$_instance->_db = App_Storage_Mysql_Connector::getInstance();
        }
        return self::$_instance;
    }
	
	public function SelectQuery($sql)
	{
        $data = $this->_db->executeReader($sql);
  			return $data;
	}
    
    public function InsertDeleteUpdateQuery($sql)
	{
        $data = $this->_db->executeReader($sql); 
  			if(!isset($data))
                return 0;
            else
                return 1;
	}
    
    public function CatChuoi($str)
    {
        return explode(',', $str);
    }
    
    public function GetidCategory()
    {
        $idpage = $_SESSION['idpage'];

        $sql = "Select idloaisp, tenloaisp ";
        $sql.= "From ishali_loaisp ";
        $sql.= "Where anhien = 1 and idpage = ". $idpage ." order by vitri";
        $data = $this->SelectQuery($sql);
        return $data;
    }
	
	public function GetPageFbByIdUserFB()
	{
		$facebook = new Ishali_Facebook();
        $iduser_fb = $facebook->getuserfbid();
		$sql = "select id_pages, id_fb_page, page_name ";
		$sql.= "from ishali_pages ";
		$sql.= "where id_fb = " . $iduser_fb;
			$lpage = $this->SelectQuery($sql);
			return $lpage;
	}

}





























