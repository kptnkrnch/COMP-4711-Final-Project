<?php
/*
 * Categories model, associates with the "tbl_categories" table in the DB
 */
class Categories extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tbl_categories', 'categoryID');
    }
}
?>
