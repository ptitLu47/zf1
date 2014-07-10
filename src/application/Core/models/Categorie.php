<?php

class Core_Model_Categorie
{
    /**
     * @var number
     */
    private $id;

    /**
     * @var string
     */
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

    public function getArticles()
    {
        return $this->articles;
    }

    public function setArticles(array $articles)
    {
        $this->articles = $articles;
        return $this;
    }

    public function addArticle()
    {

    }
}