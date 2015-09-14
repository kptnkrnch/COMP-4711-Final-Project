<?php
/*
 * users model, associates with the "tbl_users" table in the DB
 */
class UsersOld extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tbl_users', 'userID');
    }
}
?>
