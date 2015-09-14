<?php
/*
 * ContactUs model, associates with the "tbl_contactus" table in the DB
 */
class ContactUs extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tbl_contactus', 'contactID');
    }
}
?>
