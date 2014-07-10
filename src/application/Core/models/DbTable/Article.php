<?php
class Core_Model_DbTable_Article extends Zend_Db_Table_Abstract
{
    //ces objets vont hérités de la BDD
    protected $_name = "article";
    protected $_primary = "article_id";

    //Table mère
    protected $_referenceMap = array(
        'FK_categorie' => array(
            'columns' =>array("categorie_id"),
            'refTableClass' => "Core_Model_DbTable_Categorie",
            'refColumns' => array("categorie_id"),
            "onUpdate" => self::CASCADE,
            "onDelete" => self::RESTRICT
        ),

        'FK_auteur' => array(
            'columns' =>array("auteur_id"),
            'refTableClass' => "Core_Model_DbTable_Auteur",
            'refColumns' => array("auteur_id"),
            "onUpdate" => self::CASCADE,
            "onDelete" => self::RESTRICT
        )
    );

}