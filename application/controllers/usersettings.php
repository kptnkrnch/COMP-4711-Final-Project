<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UserSettings extends Application {

    function __construct() {
        parent::__construct();
        $this->load->model('postmodel'); //loads the contacts model
        $this->load->model('posttags'); //loads the contacts model
        $this->restrict(3);
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'User Settings';
        $this->data['pagebody'] = 'vusersettings';
        $this->render();
    }
    
    /*
     * Used for editing posts
     * a null id brings up the master list of posts
     * a valid id brings up the edit view for that post id
     */
    function editposts($id=NULL) {
        $this->data['title'] = 'Edit Posts';
        if ($id == NULL) {
            $userid = $this->session->userdata('userID');
            $postdata = $this->postmodel->getUserPostsReversed($userid);
            $this->data['postlist'] = $postdata;
            $this->data['pagebody'] = 'vedituserposts'; //gets the view
        } else {
            $postdata = $this->postmodel->get($id);
            $this->data['postTitle'] = $postdata->postTitle;
            $this->data['postID'] = $postdata->postID;
            $this->data['postcontent'] = $postdata->content;
            $tags = $this->posttags->getPostTags($id);
            $tagdata = array();
            $tagdata['mbti'] = 0;
            $tagdata['big5'] = 0;
            $tagdata['enneagram'] = 0;
            $tagdata['socionics'] = 0;
            $tagdata['cogfunc'] = 0;
            $tagdata['character'] = 0;
            $values = $this->config->item('post_tags');
            foreach($tags as $tag) {
                if ($tag['value'] == $values['mbti']) {
                    $tagdata['mbti'] = 1;
                }
                if ($tag['value'] == $values['big5']) {
                    $tagdata['big5'] = 1;
                }
                if ($tag['value'] == $values['enneagram']) {
                    $tagdata['enneagram'] = 1;
                }
                if ($tag['value'] == $values['socionics']) {
                    $tagdata['socionics'] = 1;
                }
                if ($tag['value'] == $values['cogfunc']) {
                    $tagdata['cogfunc'] = 1;
                }
                if ($tag['value'] == $values['character']) {
                    $tagdata['character'] = 1;
                }
            }
            $this->data['posttags'] = $this->parser->parse('_settags', $tagdata, true);
            $this->data['pagebody'] = 'vedituserpost';
        }
        $this->render(); //renders the page
    }
    
    /*
     * Disables a post in the database.
     */
    function deletePost($id=NULL) {
        if ($id != NULL) {
            $this->postmodel->deletePost($id);
        }
        redirect('/usersettings/editposts');
    }
    
    /*
     * Activates a disabled blog post.
     */
    function activatePost($id=NULL) {
        if ($id != NULL) {
            $this->postmodel->activatePost($id);
        }
        redirect('/usersettings/editposts');
    }
    
    /*
     * Handles processing data from the edit post form for management.
     */
    function updatepost($id) {
        $postid = $id;
        $posttitle = $_POST['txt-posttitle'];
        $content = $_POST['txt-content'];
        
        $mbtitag = intval($_POST['txt-mbtitag']);
        $big5tag = intval($_POST['txt-big5tag']);
        $enneagramtag = intval($_POST['txt-enneagramtag']);
        $socionicstag = intval($_POST['txt-socionicstag']);
        $cogfunctag = intval($_POST['txt-cogfunctag']);
        $charactertag = intval($_POST['txt-charactertag']);
        
        /*
         * -START HANDLING OF TAGS-
         */
        
        $values = $this->config->item('post_tags');
        
        if ($mbtitag == 1) {
            $checktag = $this->posttags->findPostTags($postid, $values['mbti']);
            if ($checktag == NULL) {
                $this->posttags->insertTag($postid, $values['mbti'], NULL);
            }
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['mbti']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($big5tag == 1) {
            $checktag = $this->posttags->findPostTags($postid, $values['big5']);
            if ($checktag == NULL) {
                $this->posttags->insertTag($postid, $values['big5'], NULL);
            }
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['big5']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($enneagramtag == 1) {
            $checktag = $this->posttags->findPostTags($postid, $values['enneagram']);
            if ($checktag == NULL) {
                $this->posttags->insertTag($postid, $values['enneagram'], NULL);
            }
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['enneagram']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($socionicstag == 1) {
            $checktag = $this->posttags->findPostTags($postid, $values['socionics']);
            if ($checktag == NULL) {
                $this->posttags->insertTag($postid, $values['socionics'], NULL);
            }
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['socionics']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($cogfunctag == 1) {
            $checktag = $this->posttags->findPostTags($postid, $values['cogfunc']);
            if ($checktag == NULL) {
                $this->posttags->insertTag($postid, $values['cogfunc'], NULL);
            }
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['cogfunc']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($charactertag == 1) {
            $checktag = $this->posttags->findPostTags($postid, $values['character']);
            if ($checktag == NULL) {
                $this->posttags->insertTag($postid, $values['character'], NULL);
            }
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['character']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        /*
         * -END HANDLING OF TAGS-
         */
        
        $this->postmodel->updateUserPost($postid, $posttitle, $content);
        
        redirect('/usersettings/editposts');
    }

}
