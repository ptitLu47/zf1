<?php
class Core_Model_Auteur
{
    private $id;
    private $name;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    public function setArticles(array $articles)
    {
        $this->articles = $articles;
        return $this;
    }

    public function addArticle(Core_Model_Article $article)
    {
        $this->articles[] = $article;
        return $this;
    }


}