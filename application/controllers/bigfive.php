<?php

/**
 * Big Five theory post page.
 * 
 * controllers/bigfive.php
 *
 * ------------------------------------------------------------------------
 */
class BigFive extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'Personality Theory - Big Five';
        $this->data['pagebody'] = 'bigfive';
        $this->render();
    }

}

/* End of file bigfive.php */
/* Location: application/controllers/bigfive.php */