<?php

/*
 * controller for the friends_list view
 */
class Login extends Application {
    function __construct() {
        parent::__construct();
        $this->load->model('users'); //loads the contacts model
    }
    function index() {
        $this->data['pagebody'] = "login"; //gets view
        $this->render(); //renders page
    }
    
    /*
     * Creates a new user session after validating credentials.
     */
    function submit() {
        $data = $this->users->querySome('username', $_POST['txt-username']);
        if (count($data) == 1) { //check if user was found
            $temppass = md5($_POST['txt-password']);
            //check if the encrypted passwords match
            if ($data[0]->password == $temppass){ 
                //creating session data
                $this->session->set_userdata('userID', $data[0]->userID);
                $this->session->set_userdata('username', $data[0]->username);
                $this->session->set_userdata('userRole', $data[0]->privilege);
            } else {
                $this->data['errors'][] = "password did not match";
                $this->data['error'] = "password did not match";
            }
        } else {
            $this->data['errors'][] = "user does not exist";
            $this->data['error'] = "user does not exist";
        }
        redirect('/');
    }
    
    /*
     * destroys the current user session.
     */
    function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }
}
?>
