<?php

/**
 * Enneagram Theory post page.
 * 
 * controllers/enneagram.php
 *
 * ------------------------------------------------------------------------
 */
class Enneagram extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'Personality Theory - Enneagram';
        $this->data['pagebody'] = 'enneagram';
        $this->render();
    }

}

/* End of file enneagram.php */
/* Location: application/controllers/enneagram.php */