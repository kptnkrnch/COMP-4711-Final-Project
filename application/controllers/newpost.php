<?php

/**
 * controller for the register view.
 *
 * ------------------------------------------------------------------------
 */
class NewPost extends Application {
    
    const rpcserver = 'showcase.bcitxml.com/boss';
    const rpcport = 80;
    
    function __construct() {
        parent::__construct();
        $this->load->model('postmodel'); //loads the contacts model
        $this->load->model('images'); //loads the contacts model
        $this->load->model('posttags'); //loads the contacts model
        $this->load->model('bloginfo');
        $this->restrict(4);
    }

    
    /*
     * New post homepage, displays a form for creating a new post.
     */
    function index() {
        $this->data['title'] = 'New Post';
        $this->data['pagebody'] = 'vnewpost'; //obtains view template data
        
        $tagdata = array();
        $tagdata['mbti'] = 0;
        $tagdata['big5'] = 0;
        $tagdata['enneagram'] = 0;
        $tagdata['socionics'] = 0;
        $tagdata['cogfunc'] = 0;
        $tagdata['character'] = 0;
        $this->data['posttags'] = $this->parser->parse('_settags', $tagdata, true);
        $this->render(); //renders the page
    }
    
    /*
     * Handles storing of the new post's form data.
     */
    function submit() {
        // either create or retrieve the relevant user record
        date_default_timezone_set('America/Vancouver');
        $userID = $this->session->userdata('userID');
        $categoryID = 1;
        $postTitle = $_POST['posttitle'];
        $content = $_POST['postcontent'];
        $description = $_POST['postdescription'];
        $creationDate = date('Y-m-d');
        $lastUpdated = NULL;
        $enabled = 1;
        
        $this->postmodel->insertPost($userID, $categoryID, $postTitle, $creationDate, $lastUpdated, $enabled, $content, $description);
        $post = $this->postmodel->last();
        $postid = $post->postID;
        
        $bloginfo = $this->bloginfo->get(1);
        $link = $bloginfo->link . '/posts?post=' . $postid;
        
        
        if ($description == NULL || strlen($description) == 0) {
            $description = "No Slug Available";
        }
        
        $rpcParams = array(
                array($bloginfo->code, 'string'), 
                array($postid, 'int'), 
                array($creationDate, 'dateTime.iso8601'), 
                array($link, 'string'), 
                array($postTitle, 'string'), 
                array($description, 'string')
            );
        
        $this->notifySyndicate($rpcParams);
        
        $mbtitag = intval($_POST['txt-mbtitag']);
        $big5tag = intval($_POST['txt-big5tag']);
        $enneagramtag = intval($_POST['txt-enneagramtag']);
        $socionicstag = intval($_POST['txt-socionicstag']);
        $cogfunctag = intval($_POST['txt-cogfunctag']);
        $charactertag = intval($_POST['txt-charactertag']);
        
        $values = $this->config->item('post_tags');
        /*-BEGIN HANDLING TAGS-*/
        if ($mbtitag == 1) {
            $this->posttags->insertTag($postid, $values['mbti'], NULL);
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['mbti']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($big5tag == 1) {
            $this->posttags->insertTag($postid, $values['big5'], NULL);
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['big5']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($enneagramtag == 1) {
            $this->posttags->insertTag($postid, $values['enneagram'], NULL);
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['enneagram']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($socionicstag == 1) {
            $this->posttags->insertTag($postid, $values['socionics'], NULL);
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['socionics']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($cogfunctag == 1) {
            $this->posttags->insertTag($postid, $values['cogfunc'], NULL);
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['cogfunc']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        
        if ($charactertag == 1) {
            $this->posttags->insertTag($postid, $values['character'], NULL);
        } else {
            $checktag = $this->posttags->findPostTags($postid, $values['character']);
            if ($checktag != NULL) {
                foreach($checktag as $tag) {
                    $this->posttags->deleteTag($tag['tagID']);
                }
            }
        }
        /*-END HANDLING TAGS-*/
        
        $redirectString = "/posts?post=" . $postid;
        redirect($redirectString);
    }
    
    /*
     * Handles the submission of images, stores a reference to the image
     * in the database. Moves the image to the user images folder.
     */
    function submitimage() {
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["image-file"]["name"]);
        $extension = end($temp);
        if ((($_FILES["image-file"]["type"] == "image/gif")
                || ($_FILES["image-file"]["type"] == "image/jpeg")
                || ($_FILES["image-file"]["type"] == "image/jpg")
                || ($_FILES["image-file"]["type"] == "image/pjpeg")
                || ($_FILES["image-file"]["type"] == "image/x-png")
                || ($_FILES["image-file"]["type"] == "image/png"))
                && in_array($extension, $allowedExts)) {
            if ($_FILES["image-file"]["error"] > 0) {
                //echo "Return Code: " . $_FILES["image-file"]["error"] . "<br>";
            } else {
                //echo "Upload: " . $_FILES["image-file"]["name"] . "<br>";
                //echo "Type: " . $_FILES["image-file"]["type"] . "<br>";
                //echo "Size: " . ($_FILES["image-file"]["size"] / 1024) . " kB<br>";
                //echo "Temp file: " . $_FILES["image-file"]["tmp_name"] . "<br>";

                if (file_exists("assets/images/userimages/" . $_FILES["image-file"]["name"])) {
                    $result = $this->images->findImage($_FILES["image-file"]["name"]);
                    if ($result == false) {
                        $userID = $this->session->userdata('userID');
                        $filename = $_FILES["image-file"]["name"];
                        $this->images->insertImage($userID, $filename);
                    }
                    //echo $_FILES["image-file"]["name"] . " already exists. ";
                } else {
                    move_uploaded_file($_FILES["image-file"]["tmp_name"], "assets/images/userimages/" . $_FILES["image-file"]["name"]);
                    //echo "Stored in: " . "assets/images/userimages/" . $_FILES["image-file"]["name"];
                    $userID = $this->session->userdata('userID');
                    $filename = $_FILES["image-file"]["name"];
                    $this->images->insertImage($userID, $filename);
                }
            }
        }
        else{
            //echo "Invalid file";
        }
        
        //redirect('/management/manageimages');
    }
    
    /*
     * returns a partial view of images for the image repository dialog box.
     * returns box layout plus images.
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
    
    /*
     * returns a partial view of images for the image repository dialog box.
     * returns image section only.
     * used for updating on page change.
     */
    function getImageRepositoryImages() {
        $params = $_POST;
        $page = 1;
        if ($params['page'] != NULL) {
            $page = $params['page'];
        }
        $imagerepositoryimages = array();
        $data = $this->images->getImageRepository($page);
        $imagerepositoryimages["imagerows"] = $data;
        if ($data != null && count($data) > 0) {
            echo $this->parser->parse('_imagerepositoryimages', $imagerepositoryimages, true);
        } else {
            echo NULL;
        }
    }
    
    function notifySyndicate($params) {
        $this->load->library('xmlrpc');
        //$this->xmlrpc->server('http://showcase.bcitxml.com:80/boss');
        $this->xmlrpc->server(NewPost::rpcserver, NewPost::rpcport);
        $this->xmlrpc->method('newpost');
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
