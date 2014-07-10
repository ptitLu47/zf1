<?php

class Core_Model_Mapper_Categorie
{
    private $dbTable;

    public function __construct()
    {
        $this->dbTable = new Core_Model_DbTable_Categorie();
    }

    public function rowToObject(Zend_Db_Table_Row $row)
    {
        $categorie = new Core_Model_Categorie;
        $categorie->setId($row['categorie_id']);
        $categorie->setName($row["categorie_name"]);

        return $categorie;
    }

}