<?php

/*
 * controller for the posts view
 */
class Posts extends Application {
    function __construct() {
        parent::__construct();
        $this->load->model('postmodel'); //loads the contacts model
        $this->load->model('users');
        $this->load->model('posttags'); //loads the contacts model
        $this->load->model('comments');
    }
    function index() {
        $params = $this->input->get();
        $data = $this->postmodel->get($params['post']);
        $firstpost = $this->postmodel->getLastActivePost();
        $lastpost = $this->postmodel->getFirstActivePost();
        $nextpost = $this->postmodel->getNextActivePost($params['post']);
        $prevpost = $this->postmodel->getPreviousActivePost($params['post']);
        $this->data['pagebody'] = "posts"; //gets view
        $this->data['title'] = 'Personality Theory - ' . $data->postTitle;
        $this->data['posttitle'] = $data->postTitle;
        $this->data['postdata'] = $data->content;
        $this->data['enabled'] = $data->enabled;
        
        $user = $this->users->get($data->userID);
        $this->data['creationdate'] = date("F d, Y", strtotime($data->creationDate));
        $this->data['username'] = $user->username;
        $userrole = $this->session->userdata('userRole');
        $this->data['commentsection'] = $this->BuildCommentSection($params['post'], $userrole);
        
        $this->data['lastpost'] = $lastpost['postID'];
        $this->data['firstpost'] = $firstpost['postID'];
        $this->data['nextpost'] = $nextpost['postID'];
        $this->data['prevpost'] = $prevpost['postID'];
        
        $tags = $this->posttags->getPostTags($params['post']);
        $this->data['values'] = $this->config->item('post_tags');
        $this->data['tags'] = $tags;
        
        $this->render(); //renders page
    }
    
    function PostList($tagvalue=NULL) {
        if ($tagvalue == NULL) {
            redirect('/');
        } else {
            $data = $this->posttags->getPostIDs($tagvalue);
            if ($data == NULL || count($data) == 0) {
                redirect('/');
            }
            $this->data['pagebody'] = "vlistposts"; //gets view
            $this->data['postlist'] = $data;
            
            $tagtype = "error";
            
            $values = $this->config->item('post_tags');
            if ($tagvalue == $values['mbti']) {
                $tagtype = "MBTI";
            }
            if ($tagvalue == $values['big5']) {
                $tagtype = "Big Five";
            }
            if ($tagvalue == $values['enneagram']) {
                $tagtype = "Enneagram";
            }
            if ($tagvalue == $values['socionics']) {
                $tagtype = "Socionics";
            }
            if ($tagvalue == $values['cogfunc']) {
                $tagtype = "Cognitive Functions";
            }
            if ($tagvalue == $values['character']) {
                $tagtype = "Character Analysis";
            }
            
            $this->data['tagtype'] = $tagtype;
            $this->data['title'] = 'List Posts';
            $this->render();
        }
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
?>
