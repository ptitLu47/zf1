<?php

class Core_Service_Blog{

    private $dbAdapter;

    public function __construct()
    {
        $this->dbAdapter = Zend_Controller_Front::getInstance()
            ->getParam('bootstrap')
            ->getResource('multidb')
            ->getDb('db1');
    }

    /**
     * @param int $count
     * @return array
     */
    public function fetchLastArticles($count = 5)
    {
        $count = (int)$count;
        if(0 === (int) $count){
            throw new InvalidArgumentException('count doit être un entier supérieur à 1');
        }

       // $sql = "SELECT * FROM article ORDER BY article_id DESC LIMIT $count";

        $mapper = new Core_Model_Mapper_Article();
        $articles = $mapper->fetchAll();

        return $articles;
    }

    /**
     * @param $articleId
     * @return Core_Model_Article
     * @throws InvalidArgumentException
     */
    public function  fetchArticleById($articleId)
    {
        if(0 === (int) $articleId){
            throw new InvalidArgumentException('$articleId doit être un entier supérieur à 1');
        }

        $mapper = new Core_Model_Mapper_Article();
        $article = $mapper->find($articleId);

        return $article;
    }
}