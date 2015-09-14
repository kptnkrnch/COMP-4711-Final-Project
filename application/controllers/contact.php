<?php

/**
 * controller for the contact view.
 *
 * ------------------------------------------------------------------------
 */
class Contact extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'Contact Us';
        $this->data['pagebody'] = 'contact'; //gets the view
        $this->render(); //renders the page
    }

}