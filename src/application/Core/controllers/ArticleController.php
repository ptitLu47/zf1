<?php
/**
 * @author Lu
 * @desc Controller article
 *
 */

class Core_ArticleController extends Zend_Controller_Action
{
    private $blogSvc;

    public function init()
    {
        //tjs appellé juste après le contructeur du parent
        $this->blogSvc = new Core_Service_Blog();
    }
    public function indexAction()
    {
        $this->view->articles = $this->blogSvc->fetchLastArticles(2);

        $newArticle = new Core_Model_Article();
        $categorie = new Core_Model_Categorie();
        $auteur = new Core_Model_Auteur();

        $categorie->setId(1);
        $auteur->setId(1);

       $newArticle->setTitle('test save3')
                    ->setContent('Plop plop plop plop')
                    ->setCategorie($categorie)
                    ->setAuteur($auteur);

        //print_r($newArticle);
        $this->blogSvc->saveArticle($newArticle);

    }

    public function viewAction()
    {
        $articleId = (int) $this->getRequest()->getParam('id');
        if(0 === $articleId)
        {
            throw new Zend_Controller_Action_Exception('Article Inconnu', 404);
        }

        $article = $this->blogSvc->fetchArticleById($articleId);

        if(!$article){
            throw new Zend_Controller_Action_Exception('Article Inconnu', 404);
        }
        $this->view->article = $article;
    }
}