<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleModel
 *
 * @author root
 */
class App_Models_ArticleModel {

    private $_db;
    private static $_instance;
    
    public static function getInstance() {
        if (self::$_instance == NULL) {
            self::$_instance = new App_Models_ArticleModel();
            self::$_instance->_db = App_Storage_Mysql_Connector::getInstance();
        }
        return self::$_instance;
    }

    	public function put(App_Entities_Article $article, $isUpdate = 0) {
        $article->id_bai_viet = $this->_db->safeParams($article->id_bai_viet, 1);
        $article->ten_menu = $this->_db->safeParams($article->ten_menu);
        $article->tieu_de = $this->_db->safeParams($article->tieu_de);
        $article->noi_dung = $this->_db->safeParams($article->noi_dung);
        $article->thu_tu = $this->_db->safeParams($article->thu_tu, 1);
        $article->an_hien = $this->_db->safeParams($article->an_hien, 1);
        $article->ngay_tao = $this->_db->safeParams($article->ngay_tao, 1);
        $article->id_fb_page = $this->_db->safeParams($article->id_fb_page, 1);

        if ($isUpdate) {
            $value = "ten_menu = '" . $article->ten_menu . "'," .
                    "tieu_de = '" . $article->tieu_de . "'," .
                    "noi_dung = '" . $article->noi_dung . "'," .
                    "thu_tu = '" . $article->thu_tu . "'," .
                    "an_hien = '" . $article->an_hien . "'," .
                    "ngay_tao = '" . $article->ngay_tao . "'," .
                    "id_fb_page = '" . $article->id_fb_page . "'";

            $question = "update " . App_Entities_Article::$TABLE . " set " . $value . " where id_bai_viet=" . $article->id_bai_viet;
            $result = $this->_db->executeNonQuery($question);

            if ($result != NULL) {                
                return $article->id_bai_viet;
            }
        } else {
            $input = 'ten_menu,
						tieu_de,
						noi_dung,
						thu_tu,
						an_hien,
						ngay_tao,
						id_fb_page';
            $value = "'" . $article->ten_menu . "'," .
                    "'" . $article->tieu_de . "'," .
                    "'" . $article->noi_dung . "'," .
                    "'" . $article->thu_tu . "'," .
                    "'" . $article->an_hien . "'," .
                    "'" . $article->ngay_tao . "'," .
                    "'" . $article->id_fb_page . "'";

            $question = "insert into " . App_Entities_Article::$TABLE . " ($input) value ($value)";
            $result = $this->_db->executeNonQuery($question);

            if ($result != NULL) {
                $article->id_bai_viet = $this->_db->getNearIndex();
                return $article->id_bai_viet;
            }
        }

        return 0;
    }

    public function remove($id) {
        $id = $this->_db->safeParams($id, 1);
        $question = "delete from " . App_Entities_Article::$TABLE . " where id_bai_viet=$id";
        $result = $this->_db->executeNonQuery($question);
        return $result;
    }

    public function getDetail($id) {
        $article = new App_Entities_Article();

        $id = $this->_db->safeParams($id, 1);

        $output = 'id_bai_viet,
						ten_menu,
						tieu_de,
						noi_dung,
						thu_tu,
						an_hien,
						ngay_tao,
						id_fb_page';
        $question1 = "select " . $output . " from " . App_Entities_Article::$TABLE . " where id_bai_viet=$id";

        $result = $this->_db->executeReader($question1);
        if (!empty($result)) {
            $article = App_Entities_Article::buildData($result[0]);
        }

        return $article;
    }

    public function getListByFbPage($fbPageId) {
        $result = array();
        $output = 'id_bai_viet,
						ten_menu,
						tieu_de,
						an_hien,
						thu_tu';

        $fbPageId = $this->_db->safeParams($fbPageId, 1);
        $condition = "id_fb_page=" . $fbPageId;
//        if($anhien)
//        {
        	$condition.= " and an_hien=1";
//        }
        $order = " order by thu_tu asc";

         $query = "select " . $output . " from " . App_Entities_Article::$TABLE . " where " . $condition . $order;

        $data = $this->_db->executeReader($query);
        if (!empty($data)) {
            foreach ($data as $item) {
                $article = App_Entities_Article::buildData($item);
                $result[] = $article;
            }
        }
        return $result;
    }
    
    

    public function getListByFbPage_admin($fbPageId) {
        $result = array();
        $output = 'id_bai_viet,
						ten_menu,
						tieu_de,
						an_hien,
						thu_tu';

        $fbPageId = $this->_db->safeParams($fbPageId, 1);
        $condition = "id_fb_page=" . $fbPageId;

        $order = " order by thu_tu asc";

        $query = "select " . $output . " from " . App_Entities_Article::$TABLE . " where " . $condition . $order;

        $data = $this->_db->executeReader($query);
        if (!empty($data)) {
            foreach ($data as $item) {
                $article = App_Entities_Article::buildData($item);
                $result[] = $article;
            }
        }
        return $result;
    }
//    
  public function listArticlePages($userid )
    {
    	$pageList = App_Models_PagesModel::getInstance()->getList('','','',$userid);
    	$name ="page";
		$html = "<SELECT  onchange='show_list_article(this.value, this.options[this.selectedIndex].text)' NAME='".$name."' >";
    	
//    	$html .= "<OPTION VALUE='-1'>Chọn Trang</OPTION>";
		    foreach($pageList AS $row)
			{
				$html .= "<OPTION VALUE=\"$row[id_fb_page]\">$row[page_name]</OPTION>";
			}
		$html .= "</SELECT>";
		return $html;
    }
    
 	 public function save()
    {
    	$id_bai_viet=$_POST['id_bai_viet'];
 		$ten_menu=$_POST['ten_menu'];
 		$tieu_de=$_POST['tieu_de'];
 		$noi_dung=$_POST['noi_dung'];
 		$thu_tu=$_POST['thu_tu'];
 		$an_hien=$_POST['an_hien'];
 		$id_fb_page=$_POST['id_fb_page'];
 		$ngay_tao= time();
    	if($id_bai_viet)
    	{
    		 $value = "ten_menu = '" . $ten_menu . "'," .
                    "tieu_de = '" . $tieu_de . "'," .
                    "noi_dung = '" . $noi_dung . "'," .
                    "thu_tu = '" . $thu_tu . "'," .
                    "an_hien = '" . $an_hien . "'," .
                    "ngay_tao = '" . $ngay_tao . "'," .
                    "id_fb_page = '" . $id_fb_page . "'";

            $question = "update " . App_Entities_Article::$TABLE . " set " . $value . " where id_bai_viet=" . $id_bai_viet;
            $result = $this->_db->executeNonQuery($question);

//            if ($result != NULL) {                
//                return $article->id_bai_viet;
//            }
    	}
    	else
    	{
    		 $input = 'ten_menu,
						tieu_de,
						noi_dung,
						thu_tu,
						an_hien,
						ngay_tao,
						id_fb_page';
            $value = "'" . $ten_menu . "'," .
                    "'" . $tieu_de . "'," .
                    "'" . $noi_dung . "'," .
                    "'" . $thu_tu . "'," .
                    "'" . $an_hien . "'," .
                    "'" . $ngay_tao . "'," .
                    "'" . $id_fb_page . "'";
    		
    		 $question = "insert into " . App_Entities_Article::$TABLE . " ($input) value ($value)";
           	 $result = $this->_db->executeNonQuery($question);

//            if ($result != NULL) {
//                $article->id_bai_viet = $this->_db->getNearIndex();
//                return $article->id_bai_viet;
//            }
    	}
    }

}

