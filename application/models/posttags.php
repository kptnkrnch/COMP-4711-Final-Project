<?php
/*
 * posttags model, associates with the contacts table in the DB
 */
class PostTags extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tbl_tags', 'tagID');
    }
    
    /*
     * Inserts a tag for a post.
     */
    function insertTag($postID, $value, $description=null) {
        $tag = $this->create();
        $tag->postID = $postID;
        $tag->value = $value;
        $tag->description = $description;
        $this->add($tag);
    }
    
    /*
     * Deletes a tag.
     */
    function deleteTag($tagID) {
        $user = $this->delete($tagID);
    }
    
    /*Gets all of the tags for a specific post.*/
    function getPostTags($postID) {
        $sql = "SELECT * FROM tbl_tags WHERE postID=".$postID;
        $result = $this->query($sql);
        
        return $result;
    }
    
    /*Used to find tags the are going to be deleted.*/
    function findPostTags($postID, $value) {
        $sql = "SELECT * FROM tbl_tags WHERE postID=".$postID." AND value=".$value;
        $result = $this->query($sql);
        
        if ($result != NULL && count($result) > 0) {
            return $result;
        } else {
            return NULL;
        }
    }
    
    /*
     * Gets all of the posts associated with a certain tag type.
     */
    function getPostIDs($value) {
        $sql = "SELECT tbl_posts.postID, tbl_posts.postTitle, tbl_posts.creationDate"
                . " FROM tbl_posts RIGHT JOIN tbl_tags ON tbl_tags.postID = tbl_posts.postID"
                . " WHERE tbl_tags.value=". $value ." ORDER BY tbl_posts.creationDate DESC";
        $result = $this->query($sql);
        
        if ($result != NULL && count($result) > 0) {
            return $result;
        } else {
            return NULL;
        }
        
    }
}
?>
