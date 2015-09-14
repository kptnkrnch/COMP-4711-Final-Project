<?php

/**
 * Links of interest page.
 * 
 * controllers/links.php
 *
 * ------------------------------------------------------------------------
 */
class Links extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'Personality Theory - Links';
        $this->data['pagebody'] = 'links';
        $this->render();
    }

}

/* End of file links.php */
/* Location: application/controllers/links.php */