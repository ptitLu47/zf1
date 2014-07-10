<?php

class Core_Model_Mapper_Auteur
{
    private $dbTable;

    public function __construct()
    {
        $this->dbTable = new Core_Model_DbTable_Auteur();
    }

    public function rowToObject(Zend_Db_Table_Row $row)
    {
        $auteur = new Core_Model_Auteur;
        $auteur->setId($row['auteur_id']);
        $auteur->setName($row["auteur_name"]);

        return $auteur;
    }

}