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

        $sql = $this->dbAdapter
                    ->select()
                    ->from('article')
                    ->order('article_id')
                    ->limit($count);

        $result = $this->dbAdapter->fetchAll($sql, $count);



        $articles = array();
        foreach ($result as $row){
            $article = new Core_Model_Article();
            $article->setId($row['article_id']);
            $article->setTitle($row["article_title"]);
            $article->setContent($row["article_content"]);

            $articles[] = $article;
        }
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

        $dbAdapter = Zend_Controller_Front::getInstance()->getParam('bootstrap')
                                                         ->getResource('multidb')
                                                         ->getDb('db1');

        $sql = "SELECT * FROM article WHERE article_id = ?";
        $result = $dbAdapter->fetchAll($sql, $articleId);

        //print_r($result);

        if( 0 === count($result)){
            return false;
        }
        $article = new Core_Model_Article();
        $article->setId($articleId);
        $article->setTitle($result[0]["article_title"]);
        $article->setContent($result[0]["article_content"]);
        return $article;
    }
}