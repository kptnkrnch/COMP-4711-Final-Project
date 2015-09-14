<?php
/*
 * contacts model, associates with the contacts table in the DB
 */
class Contacts extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('contacts', 'id');
    }
}
?>
