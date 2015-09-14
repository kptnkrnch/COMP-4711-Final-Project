<?php

/**
 * Meyers Briggs Type Indicator Theory Post page.
 * 
 * controllers/mbti.php
 *
 * ------------------------------------------------------------------------
 */
class MBTI extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'Personality Theory - MBTI';
        $this->data['pagebody'] = 'mbti';
        $this->render();
    }

}

/* End of file mbti.php */
/* Location: application/controllers/mbti.php */