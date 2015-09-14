<?php
/*
 * posts model, associates with the "tbl_posts" table in the DB
 */
class PostModel extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tbl_posts', 'postID');
    }
    
    /*
     * Inserts a new post into the database.
     * Needs error handling.
     */
    function insertPost($userID, $categoryID, $postTitle, $creationDate, $lastUpdated, $enabled, $content, $description) {
        $newpost = $this->create();
        $newpost->userID = $userID;
        $newpost->categoryID = $categoryID;
        $newpost->postTitle = $postTitle;
        $newpost->creationDate = $creationDate;
        $newpost->lastUpdate = $lastUpdated;
        $newpost->enabled = $enabled;
        $newpost->content = $content;
        $newpost->description = $description;
        date_default_timezone_set('America/Vancouver');
        $mysqldate = date('Y-m-d H:i:s');
        $newpost->creationDate = $mysqldate;
        $this->add($newpost);
    }
    
    /*
     * Updates a post from admin.
     * Needs error handling.
     */
    function updatePost($postid, $userid, $categoryid, $posttitle, $creationDate, 
                            $lastUpdated, $enabled, $content) {
        $post = $this->get($postid);
        $post->userID = $userid;  
        $post->categoryID = $categoryid;
        $post->postTitle = $posttitle;
        $post->creationDate = $creationDate;
        $post->lastUpdate = $lastUpdated;
        $post->enabled = $enabled;
        $post->content = $content;
        $this->update($post);
    }
    
    /*
     * Updates a post from user.
     * Needs error handling.
     */
    function updateUserPost($postid, $posttitle, $content) {
        $post = $this->get($postid);
        date_default_timezone_set('America/Vancouver');
        $lastUpdated = date('Y-m-d');
        $post->postTitle = $posttitle;
        $post->lastUpdate = $lastUpdated;
        $post->content = $content;
        $this->update($post);
    }
    
    /*
     * Disables a post in the database.
     */
    function deletePost($postID) {
        $post = $this->get($postID);
        $post->enabled = 0;
        $this->update($post);
    }
    
    /*
     * Activates a post in the database.
     */
    function activatePost($postID) {
        $post = $this->get($postID);
        $post->enabled = 1;
        $this->update($post);
    }
    
    /*
     * Retrieves that last active post (used on homepage).
     * Used in pagination.
     */
    function getLastActivePost() {
        $sql = "SELECT * FROM tbl_posts WHERE enabled=1 ORDER BY creationDate DESC LIMIT 1";
        $result = $this->query($sql);
        
        if (count($result) >= 1) {
            return $result[0];
        } else {
            return NULL;
        }
    }
    
    /*
     * Retrieves First active post.
     * Used in pagination.
     */
    function getFirstActivePost() {
        $sql = "SELECT * FROM tbl_posts WHERE enabled=1 ORDER BY creationDate ASC LIMIT 1";
        $result = $this->query($sql);
        
        if (count($result) >= 1) {
            return $result[0];
        } else {
            return NULL;
        }
    }
    
    /*
     * Gets the next active post from the current post.
     * Used for pagination.
     */
    function getNextActivePost($postid) {
        $sql = "SELECT * FROM tbl_posts WHERE enabled=1 AND postID < "
                . $postid ." ORDER BY postID DESC LIMIT 1";
        $result = $this->query($sql);
        
        if (count($result) >= 1) {
            return $result[0];
        } else {
            $result = array('postID' => $postid);
            return $result;
        }
    }
    
    /*
     * Gets the previous active post from the current post.
     * Used for pagination.
     */
    function getPreviousActivePost($postid) {
        $sql = "SELECT * FROM tbl_posts WHERE enabled=1 AND postID > "
                . $postid ." ORDER BY postID ASC LIMIT 1";
        $result = $this->query($sql);
        
        if (count($result) >= 1) {
            return $result[0];
        } else {
            $result = array('postID' => $postid);
            return $result;
        }
    }
    
    /*
     * Gets all of the userposts in reverse.
     */
    function getUserPostsReversed($userid) {
        $sql = "SELECT * FROM tbl_posts WHERE userID=" . $userid . " ORDER BY postID DESC";
        $result = $this->query($sql);
        
        if ($result != NULL && count($result) >= 1) {
            return $result;
        } else {
            return NULL;
        }
    }
    
}
?>
