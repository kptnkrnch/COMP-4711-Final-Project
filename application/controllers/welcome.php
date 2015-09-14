<?php

/**
 * The homepage. Will contain the most recent post.
 * 
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct() {
        parent::__construct();
        $this->load->model('postmodel'); //loads the contacts model
        $this->load->model('users');
        $this->load->model('posttags'); //loads the contacts model
        $this->load->model('comments');
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $data = $this->postmodel->getLastActivePost();
        $this->data['title'] = 'Personality Theory - ' . $data['postTitle'];
        $this->data['pagebody'] = 'welcome';
        if ($data == NULL) {
            $this->data['postdata'] = "-post unavailable-";
            $this->data['posttitle'] = "an error occurred";
            $this->data['lastpost'] = "";
            $this->data['firstpost'] = "";
            $this->data['nextpost'] = "";
            $this->data['prevpost'] = "";
            $this->data['values'] = $this->config->item('post_tags');
            $this->data['tags'] = NULL;
        } else {
            $this->data['postdata'] = $data['content'];//$data->content;
            $this->data['posttitle'] = $data['postTitle'];//$data->postTitle;
            $firstpost = $this->postmodel->getLastActivePost();
            $lastpost = $this->postmodel->getFirstActivePost();
            $nextpost = $this->postmodel->getNextActivePost($data['postID']);
            $prevpost = $this->postmodel->getPreviousActivePost($data['postID']);
            $this->data['lastpost'] = $lastpost['postID'];
            $this->data['firstpost'] = $firstpost['postID'];
            $this->data['nextpost'] = $nextpost['postID'];
            $this->data['prevpost'] = $prevpost['postID'];
            
            $user = $this->users->get($data['userID']);
            $this->data['creationdate'] = date("F d, Y", strtotime($data['creationDate']));
            $this->data['username'] = $user->username;
            $userrole = $this->session->userdata('userRole');
            $this->data['commentsection'] = $this->BuildCommentSection($data['postID'], $userrole);
            
            $tags = $this->posttags->getPostTags($data['postID']);
            $this->data['values'] = $this->config->item('post_tags');
            $this->data['tags'] = $tags;
        }
        $this->render();
    }
    
    function BuildCommentSection($postID, $userrole) {
        $data = $this->comments->GetComments($postID);
        $comment_list = array();
        if ($data != NULL) {
            foreach($data as $comment) {
                $comment_list['comment_list'][] = array('content' => $comment['content'], 
                        'username' => $comment['username'], 
                        'date' => date("F d, Y", strtotime($comment['creationDate'])),
                        'postID' => $postID,
                        'userrole' => $userrole);
            }
        } else {
            $nocontent = "No comments available.";
            $comment_list['comment_list'][] = array('content' => $nocontent, 'username' => NULL, 'date' => NULL, 'postID' => $postID,
                'userrole' => $userrole);
        }
        
        return $this->parser->parse('_comment', $comment_list, true);
    }

}

/* End of file welcome.php */
/* Location: application/controllers/welcome.php */