<?php

class ArticleController extends App_Controller_FrontController {

    public function init() {
        parent::init();
    }

    public function indexAction() {
        $request = $this->getRequest();
        $articleId = $request->getParam("articleId", 0);
        $article = new App_Entities_Article();
        $article = App_Models_ArticleModel::getInstance()->getDetail($articleId);

        $this->view->article = $article;
    }

}
