<?php

/*
 * controller for the friends_list view
 */
class Usermtce extends Application {
    function __construct() {
        parent::__construct();
        $this->load->model('users'); //loads the contacts model
    }
    function index() {
        $this->data['pagebody'] = "user_admin"; //gets view
        $this->data['users'] = $this->users->getAll_array(); //gets contact list data
        $this->render(); //renders page
    }
    
    function add() {
        $user = (array) $this->users->create();
        $this->data = array_merge($this->data, $user);
        $this->data['pagebody'] = 'user_add';
        $this->render();
    }
    
    function edit($id) {
        $user = (array) $this->users->get($id);
        $this->data = array_merge($this->data, $user);
        //$this->data['id'] = $user['userID'];
        $this->data['password'] = ''; // assume password to remain the same
        $this->data['pagebody'] = 'user_edit';
        $this->render();
    }
    
    function delete($id) {
        $this->users->delete($id);
        $this->index();
    }
    
    function submit($id=null) {
        // either create or retrieve the relevant user record
        if ($id == null || $id == 'new') {
            $user = $this->users->create();
        } else {
            $user = $this->users->get($id);
        }
        
        if ($id != null) {
            $user_fields = array('userID', 'username', 'password', 'firstname', 
                'lastname', 'email', 'privilege', 'enabled', 'creationDate');

            // over-ride the user record fields with submitted values
            fieldExtract($_POST, $user, $user_fields);

            // validate the user fields
            if ($_POST['userID'] == 'new' || empty($_POST['userID'])) {
                $this->data['errors'][] = 'You need to specify a userid';
            }
            if ($this->users->exists($_POST['id'])) {
                $this->data['errors'][] = 'That userid is already used';
            }
            if (strlen($user->username) < 1) {
                $this->data['errors'][] = 'You need a user name';
            }
            if (strlen($user->email) < 1) {
                $this->data['errors'][] = 'You need an email address';
            }
            if (!strpos($user->email, '@')) {
                $this->data['errors'][] = 'The email address is missing the domain';
            }

            // if errors, redisplay the form
            if (count($this->data['errors']) > 0) {
                // over-ride the view parameters to reflect our data
                $this->data = array_merge($this->data, (array) $user);
                $this->data['pagebody'] = 'user_edit';
                $this->render();
                exit;
            }
        } else {
            $user_fields = array('username', 'password', 'firstname', 
                'lastname', 'email', 'privilege', 'enabled');

            // over-ride the user record fields with submitted values
            fieldExtract($_POST, $user, $user_fields);

            // validate the user fields
            if (strlen($user->username) < 1) {
                $this->data['errors'][] = 'You need a user name';
            }
            if (strlen($user->email) < 1) {
                $this->data['errors'][] = 'You need an email address';
            }
            if (!strpos($user->email, '@')) {
                $this->data['errors'][] = 'The email address is missing the domain';
            }
            if (empty($user->password)) {
                $this->data['errors'][] = 'You must specify a password';
            }

            // if errors, redisplay the form
            if (count($this->data['errors']) > 0) {
                // over-ride the view parameters to reflect our data
                $this->data = array_merge($this->data, (array) $user);
                $this->data['pagebody'] = 'user_add';
                $this->render();
                exit;
            }
        }

        // handle the password specially, as it needs to be encrypted
        $new_password = $_POST['password'];
        if (!empty($new_password)) {
            $new_password = md5($new_password);
            echo $new_password;
            if ($new_password != $user->password)
                $user->password = $new_password;
        }

        // either add or update the user record, as appropriate
        if ($id == null) {
            date_default_timezone_set('America/Vancouver');
            $mysqldate = date('Y-m-d H:i:s');
            $user->creationDate = $mysqldate;
            $user->lastUpdate = NULL;
            $this->users->add($user);
        } else {
            date_default_timezone_set('America/Vancouver');
            $mysqldate = date('Y-m-d H:i:s');
            $user->lastUpdate = $mysqldate;
            $this->users->update($user);
        }

        // redisplay the list of users
        redirect('/usermtce');
    }
}
?>
