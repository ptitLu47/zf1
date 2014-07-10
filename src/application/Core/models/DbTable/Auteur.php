<?php
class Core_Model_DbTable_Auteur extends Zend_Db_Table_Abstract
{
    //ces objets vont hérités de la BDD
    protected $_name = "auteur";
    protected $_primary = "auteur_id";

    //table filles
    protected $_dependentTables = array(
        'Core_Model_DbTable_Article'
    );

}