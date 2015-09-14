<?php

/**
 * controller for the about view.
 *
 * ------------------------------------------------------------------------
 */
class About extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'About Us';
        $this->data['pagebody'] = 'about'; //gets the view
        $this->render(); //renders the page
    }

}