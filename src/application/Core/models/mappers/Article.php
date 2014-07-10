<?php

class Core_Model_Mapper_Article
{
    public function __construct()
    {
        $this->dbTable = new Core_Model_DbTable_Article();
    }
    public function find($id)
    {
        $rowArticle = $this->dbTable->find($id)->current();
        $article = $this->rowToObject($rowArticle);
        return $article;
    }

    public function fetchAll($where=null, $order=null, $count=null, $offset=null)
    {
        $result = $this->dbTable->fetchAll($where,$order,$count,$offset);
        $articles = array();
        foreach ($result as $row){
            $articles[] = $this->rowToObject($row);
        }
        return $articles;
    }

    public function delete($id)
    {
        $row = $this->dbTable->find($id)->current();
        if($row instanceof Zend_Db_Table_Abstract){
            throw new Zend_Db_Table_Exception('Impossible de supprimer l\'élément N°'.$id);
        }
        return (bool)$row->delete();
    }

    public function save(Core_Model_Article $article)
    {
        $origin = $this->dbTable->find($article->getId())->current();
        $row = $this->objectToRow($article);

        if($origin instanceof Zend_Db_Table_Row_Abstract)
        {
            $where = array('article_id = ?' => $article->getId());
            $this->dbTable->update($row,$where);
        }else{
            unset($row['article_id']); //détruit l'id de l 'article pour en recréer un qui incrémenté
           // echo $row['article_title'];
           // echo "lalala";
            $this->dbTable->insert($row);
        }
    }


    public function rowToObject(Zend_Db_Table_Row $row)
    {
        $article = new Core_Model_Article;
        $article->setId($row['article_id']);
        $article->setTitle($row["article_title"]);
        $article->setContent($row["article_content"]);

        //CATEGORIE
        $rowCategorie = $row->findParentRow('Core_Model_DbTable_Categorie');
        $mapperCategorie = new Core_Model_Mapper_Categorie();
        $categorie = $mapperCategorie->rowToObject($rowCategorie);

        //AUTEUR
        $rowAuteur = $row->findParentRow('Core_Model_DbTable_Auteur');
        $mapperAuteur = new Core_Model_Mapper_Auteur();
        $auteur = $mapperAuteur->rowToObject($rowAuteur);

        $auteur->addArticle($article);

        $categorie->addArticle($article);
        $article->setCategorie($categorie);
        $article->setAuteur($auteur);

        //$article->setAuteur($auteur);
        //$auteur->addArticle($article);
        //$article->setCategorie($auteur);

        return $article;
    }

    public function objectToRow(Core_Model_Article $article)
    {
        return ["article_id" => $article->getId(),
                     "article_title" => $article->getTitle(),
                     "article_content" => $article->getContent(),
                     "categorie_id" => $article->getCategorie()->getId(),
                     "auteur_id" => $article->getAuteur()->getId()
        ];
    }
}