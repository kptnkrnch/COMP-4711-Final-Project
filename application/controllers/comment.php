<?php

/**
 * controller for the about view.
 *
 * ------------------------------------------------------------------------
 */
class Comment extends Application {

    function __construct() {
        parent::__construct();
        $this->load->model('comments');
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        redirect('/');
    }
    
    function newcomment($id) {
        $comment = $_POST['newcomment'];
        $userID = $this->session->userdata('userID');
        $this->comments->CreateComment($userID, $id, $comment);
        redirect('/posts?post=' . $id);
    }

}