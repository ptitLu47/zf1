<?php
class Core_Model_DbTable_Categorie extends Zend_Db_Table_Abstract
{
    //ces objets vont hérités de la BDD
    protected $_name = "categorie";
    protected $_primary = "categorie_id";

    //table filles
    protected $_dependentTables = array(
        'Core_Model_DbTable_Article'
    );

}