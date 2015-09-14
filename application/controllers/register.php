<?php

/**
 * controller for the register view.
 *
 * ------------------------------------------------------------------------
 */
class Register extends Application {

    function __construct() {
        parent::__construct();
        $this->load->model('users'); //loads the contacts model
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'Register';
        $this->data['pagebody'] = 'register'; //obtains view template data
        $this->render(); //renders the page
    }
    
    /*
     * Used for handling new user form data and then storing it in the database.
     */
    function submit() {
        // either create or retrieve the relevant user record
        $user = $this->users->create();
        $user_fields = array('username', 'password', 'cpassword', 
            'firstname', 'lastname', 'email');
        
        $user_fields['username'] = $_POST['txt-username'];
        $user_fields['password'] = $_POST['txt-password'];
        $user_fields['cpassword'] = $_POST['txt-cpassword'];
        $user_fields['firstname'] = $_POST['txt-firstname'];
        $user_fields['lastname'] = $_POST['txt-lastname'];
        $user_fields['email'] = $_POST['txt-email'];
        
        $user->username = $_POST['txt-username'];
        $user->firstname = $_POST['txt-firstname'];
        $user->lastname = $_POST['txt-lastname'];
        $user->email = $_POST['txt-email'];
        $user->privilege = ROLE_USER;
        $user->enabled = 1;
        date_default_timezone_set('America/Vancouver');
        $mysqldate = date('Y-m-d');
        $user->creationDate = $mysqldate;
        $user->lastUpdate = NULL;

        // over-ride the user record fields with submitted values
        //fieldExtract($_POST, $user, $user_fields);

        // validate the user fields
        if (strlen($user_fields['username']) < 1) {
            $this->data['errors'][] = 'You need a user name';
        }
        if (strlen($user_fields['email']) < 1) {
            $this->data['errors'][] = 'You need an email address';
        }
        if (!strpos($user_fields['email'], '@')) {
            $this->data['errors'][] = 'The email address is missing the domain';
        }
        if (empty($user_fields['password'])) {
            $this->data['errors'][] = 'You must specify a password';
        }
        if (empty($user_fields['cpassword'])) {
            $this->data['errors'][] = 'You must specify a password for comparison';
        }

        // if errors, redisplay the form
        /*if (count($this->data['errors']) > 0) {
            // over-ride the view parameters to reflect our data
            $this->data = array_merge($this->data, (array) $user);
            $this->data['pagebody'] = 'user_add';
            $this->render();
            exit;
        }*/

        // handling of the password
        $password = $_POST['txt-password'];
        if (!empty($password) && $user_fields['cpassword'] === $user_fields['password']) {
            $password = md5($password); //encrypting the password
            $user->password = $password; //assigning encrypted password to the user model
        }

        //add a creationdate if it is a new user
            
        $this->users->add($user);

        // redisplay the list of users
        redirect('/');
    }

}
