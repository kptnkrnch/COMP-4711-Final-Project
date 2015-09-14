<?php

/*
 * controller for the friends_list view
 */
class Editposts extends Application {
    function __construct() {
        parent::__construct();
        $this->load->model('users'); //loads the contacts model
    }
    function index() {
        $this->data['pagebody'] = "veditposts"; //gets view
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
    
    function submit($id) {
        
    }
}
?>
