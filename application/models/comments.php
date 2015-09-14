<?php
/*
 * Comments model, associates with the "tbl_comments" table in the DB
 */
class Comments extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tbl_comments', 'commentID');
    }
    
    function CreateComment($userID, $postID, $content) {
        $newcomment = $this->create();
        $newcomment->userID = $userID;
        $newcomment->postID = $postID;
        $newcomment->content = $content;
        date_default_timezone_set('America/Vancouver');
        $mysqldate = date('Y-m-d H:i:s');
        $newcomment->creationDate = $mysqldate;
        $newcomment->lastUpdate = NULL;
        $newcomment->enabled = 1;
        $this->add($newcomment);
    }
    
    function GetComments($postID) {
        $query = "SELECT tbl_comments.userID, tbl_comments.content, tbl_comments.creationDate, tbl_users.username FROM tbl_comments"
                . " JOIN tbl_users ON tbl_comments.userID = tbl_users.userID"
                . " WHERE tbl_comments.postID=" . $postID . " ORDER BY tbl_comments.creationDate ASC;";
        return $this->query($query);
    }
}
?>
