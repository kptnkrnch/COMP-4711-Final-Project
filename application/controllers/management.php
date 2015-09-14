<?php

/**
 * controller for the about view.
 *
 * ------------------------------------------------------------------------
 */
class Management extends Application {
    
    const rpcserver = 'showcase.bcitxml.com/boss';
    const rpcport = 80;
    
    function __construct() {
        parent::__construct();
        $this->load->model('postmodel'); //loads the contacts model
        $this->load->model('users'); //loads the contacts model
        $this->load->model('images'); //loads the contacts model
        $this->load->model('posttags'); //loads the contacts model
        $this->load->model('bloginfo');
        $this->restrict(4);
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'Management';
        $this->data['pagebody'] = 'vmanagement'; //gets the view
        $this->render(); //renders the page
    }
    
    /*
     * Used for editing users.
     * a null id brings up the master list of all users.
     * a valid id brings up the edit view for that user id.
     */
    function editusers($id=NULL) {
        $this->data['title'] = 'Edit Users';
        if ($id == NULL) {
            $userdata = $this->users->getAll_array_reversed();
            $this->data['userlist'] = $userdata;
            $this->data['pagebody'] = 'veditusers'; //gets the view
        } else {
            $userdata = $this->users->get($id);
            $this->data['userid'] = $userdata->userID;
            $this->data['username'] = $userdata->username;
            $this->data['firstname'] = $userdata->firstname;
            $this->data['lastname'] = $userdata->lastname;
            $this->data['email'] = $userdata->email;
            $this->data['creationDate'] = $userdata->creationDate;
            $this->data['lastUpdate'] = $userdata->lastUpdate;
            $this->data['privilege'] = $userdata->privilege;
            $this->data['enabled'] = $userdata->enabled;
            $this->data['pagebody'] = 'vedituser';
        }
        $this->render(); //renders the page
    }
    
    /* 
     * Used for editing posts
     * a null id brings up the master list of posts
     * a valid id brings up the edit view for that post id
     */
    function editposts($id=NULL) {
        $this->data['title'] = 'Edit Posts';
        if ($id == NULL) {
            $postdata = $this->postmodel->getAll_array_reversed();
            $this->data['postlist'] = $postdata;
            $this->data['pagebody'] = 'veditposts'; //gets the view
        } else {
            $postdata = $this->postmodel->get($id);
            $this->data['postTitle'] = $postdata->postTitle;
            $this->data['postID'] = $postdata->postID;
            $this->data['userID'] = $postdata->userID;
            $this->data['categoryID'] = $postdata->categoryID;
            $this->data['creationDate'] = date("Y-m-d");
            $this->data['lastUpdate'] = $postdata->lastUpdate;
            $this->data['enabled'] = $postdata->enabled;
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
            $this->data['pagebody'] = 'veditpost';
        }
        $this->render(); //renders the page
    }
    /*
     * Used for managing images, renders the vmanageimages view.
     */
    function manageimages() {
        $params = $this->input->get();
        $page = 1;
        if ($params['page'] != NULL) {
            $page = $params['page'];
        }
        $this->data['title'] = 'Manage Images';
        $imagedata = $this->images->getImages($page);
        $this->data['imagerows'] = $imagedata;
        $this->data['pagebody'] = 'vmanageimages'; //gets the view
        $this->render(); //renders the page
    }
    
    /*
     * Handles processing data from the edit user form for management.
     */
    function updateuser($id) {
        $userid = $id;
        $username = $_POST['txt-username'];
        $fname = $_POST['txt-firstname'];
        $lname = $_POST['txt-lastname'];
        $email = $_POST['txt-email'];
        $creationDate = $_POST['txt-creationdate'];
        $lastUpdated = $_POST['txt-lastupdated'];
        $privilege = $_POST['txt-privilege'];
        $enabled = $_POST['txt-enabled'];
        if ($_POST['txt-password'] != NULL 
                && $_POST['txt-cpassword'] != NULL
                && strlen($_POST['txt-password']) > 0
                && strlen($_POST['txt-cpassword']) > 0
                && $_POST['txt-password'] == $_POST['txt-cpassword']) {
            
            $password = $_POST['txt-password'];
            $this->users->updateUser($userid, $username, $password, $fname, $lname, $email, 
                        $creationDate, $lastUpdated, $privilege, $enabled);
        } else {
            $this->users->updateUser($userid, $username, NULL, $fname, $lname, $email, 
                        $creationDate, $lastUpdated, $privilege, $enabled);
        }
        redirect('/management/editusers');
    }
    
    /*
     * Handles processing data from the edit post form for management.
     */
    function updatepost($id) {
        $postid = $id;
        $userid = $_POST['txt-userid'];
        $categoryid = $_POST['txt-categoryid'];
        $posttitle = $_POST['txt-posttitle'];
        $creationDate = $_POST['txt-creationdate'];
        $lastUpdated = $_POST['txt-lastupdated'];
        if ($lastUpdated == NULL || empty($lastUpdated)) {
            date_default_timezone_set('America/Vancouver');
            $lastUpdated = date('Y-m-d');
        }
        $enabled = $_POST['txt-enabled'];
        $content = $_POST['txt-content'];
        
        $mbtitag = intval($_POST['txt-mbtitag']);
        $big5tag = intval($_POST['txt-big5tag']);
        $enneagramtag = intval($_POST['txt-enneagramtag']);
        $socionicstag = intval($_POST['txt-socionicstag']);
        $cogfunctag = intval($_POST['txt-cogfunctag']);
        $charactertag = intval($_POST['txt-charactertag']);
        
        $values = $this->config->item('post_tags');
        /*
         * -START HANDLING OF TAGS-
         */
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
        
        $this->postmodel->updatePost($postid, $userid, $categoryid, $posttitle,
                    $creationDate, $lastUpdated, $enabled, $content);
        
        redirect('/management/editposts');
    }
    
    /*
     * Handles the submission of images, stores a reference to the image
     * in the database. Moves the image to the user images folder.
     */
    function submitimage() {
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "image/x-png")
                || ($_FILES["file"]["type"] == "image/png"))
                && in_array($extension, $allowedExts)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
            } else {
                echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                echo "Type: " . $_FILES["file"]["type"] . "<br>";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                if (file_exists("assets/images/userimages/" . $_FILES["file"]["name"])) {
                    $result = $this->images->findImage($_FILES["file"]["name"]);
                    if ($result == false) {
                        $userID = $this->session->userdata('userID');
                        $filename = $_FILES["file"]["name"];
                        $this->images->insertImage($userID, $filename);
                    }
                    echo $_FILES["file"]["name"] . " already exists. ";
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"], "assets/images/userimages/" . $_FILES["file"]["name"]);
                    echo "Stored in: " . "assets/images/userimages/" . $_FILES["file"]["name"];
                    $userID = $this->session->userdata('userID');
                    $filename = $_FILES["file"]["name"];
                    $this->images->insertImage($userID, $filename);
                }
            }
        }
        else{
            echo "Invalid file";
        }
        
        redirect('/management/manageimages');
    }
    /*
     * Deletes an image from the database.
     */
    function deleteImage() {
        $params = $_POST;
        $imageid = -1;
        if ($params['imageid'] != NULL) {
            $imageid = $params['imageid'];
            $this->images->deleteImage($imageid);
        }
    }
    /*
     * Disables a post in the database.
     */
    function deletePost($id=NULL) {
        if ($id != NULL) {
            $this->postmodel->deletePost($id);
        }
        redirect('/management/editposts');
    }
    /*
     * Activates a disabled blog post.
     */
    function activatePost($id=NULL) {
        if ($id != NULL) {
            $this->postmodel->activatePost($id);
        }
        redirect('/management/editposts');
    }
    /*
     * Disables a user account
     */
    function deleteUser($id=NULL) {
        if ($id != NULL) {
            $this->users->deleteUser($id);
        }
        redirect('/management/editusers');
    }
    /*
     * enables a user account
     */
    function activateUser($id=NULL) {
        if ($id != NULL) {
            $this->users->activateUser($id);
        }
        redirect('/management/editusers');
    }
    /*
     * returns a partial view of images for the image repository dialog box.
     */
    function getImageRepository() {
        $params = $_POST;
        $page = 1;
        if ($params['page'] != NULL) {
            $page = $params['page'];
        }
        $imagerepository = array();
        $imagerepository["imagerows"] = $this->images->getImageRepository($page);
        echo $this->parser->parse('_imagerepository', $imagerepository, true);
    }
    
    function editBlogInfo() {
        $blogdata = $this->bloginfo->get(1);
        $this->data['blogcode'] = $blogdata->code;
        $this->data['blogname'] = $blogdata->name;
        $this->data['bloglink'] = $blogdata->link;
        $this->data['blogdescription'] = $blogdata->plug;

        $this->data['pagebody'] = 'veditblog';
            
        $this->render(); //renders the page
    }
    
    function UpdateBlogInfo() {
        
        $code = $_POST['blogcode'];
        $name = $_POST['blogname'];
        $link = $_POST['bloglink'];
        $description = $_POST['blogdescription'];
        
        $this->bloginfo->UpdateBlogInfo($code, $name, $link, $description);
        
        $rpcParams = array(
                array($code, 'string'), 
                array($name, 'string'), 
                array($link, 'string'), 
                array($description, 'string')
            );
        
        $this->notifySyndicate($rpcParams);
        
        redirect('/management');
    }
    
    function notifySyndicate($params) {
        $this->load->library('xmlrpc');
        //$this->xmlrpc->server('http://showcase.bcitxml.com:80/boss');
        $this->xmlrpc->server(Management::rpcserver, Management::rpcport);
        $this->xmlrpc->method('update');
        //$this->xmlrpc->set_debug(TRUE);

        //specify the parameters
        $this->xmlrpc->request($params);

        //send the request
        if (!$this->xmlrpc->send_request()) {
            echo $this->xmlrpc->display_error();
            exit();
        }

        //and return the response
        return $this->xmlrpc->display_response();
    }

}