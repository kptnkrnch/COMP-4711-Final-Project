<?php
/*
 * contacts model, associates with the contacts table in the DB
 */
class Users extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tbl_users', 'userID');
    }
    
    /*
     * Admin function: updates all user fields.
     */
    function updateUser($userid, $username, $password, $fname, $lname, $email, 
                        $creationDate, $lastUpdated, $privilege, $enabled) {
        $user = $this->get($userid);
        $user->username = $username;
        if ($password != NULL && !empty($password)) {
            $password = md5($password);
            $user->password = $password;
        }   
        $user->firstname = $fname;
        $user->lastname = $lname;
        $user->email = $email;
        $user->creationDate = $creationDate;
        $user->lastUpdate = $lastUpdated;
        $user->privilege = $privilege;
        $user->enabled = $enabled;
        $this->update($user);
    }
    
    /*
     * Disables a user.
     */
    function deleteUser($userID) {
        $user = $this->get($userID);
        $user->enabled = 0;
        $this->update($user);
    }
    
    /*
     * Activates a user.
     */
    function activateUser($userID) {
        $user = $this->get($userID);
        $user->enabled = 1;
        $this->update($user);
    }
}
?>
