<?php

class Core_Model_Article
{
    /**
     * @var number
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var number
     */
    private $categorie;

    /**
     * @var number
     */
    private $auteur;

    /**
     * @param number $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
        return $this;
    }

    /**
     * @return number
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param number $categorie
     * Core_Model_Categorie
     */
    public function setCategorie(Core_Model_Categorie $categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * @return number
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

}

