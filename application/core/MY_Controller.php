<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2013, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['title'] = '?';
        $this->errors = array();
        $this->data['pageTitle'] = '??';
        $this->load->model('postmodel'); //loads the contacts model
    }

    /**
     * Render this page
     */
    function render() {
        $this->data['menubar'] = $this->build_menu_bar($this->config->item('menu_choices'));
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['archive'] = $this->build_archive();

        // finally, build the browser page!
        $this->data['data'] = &$this->data;
        $this->data['login'] = $this->build_login();
        $this->parser->parse('_template', $this->data);
    }

    /**
     * Build an unordered list of linked items, such as used for a menu bar.
     * @param mixed $choices Array of name=>link pairs
     */
    function build_menu_bar($choices) {
        $menudata = array();
        foreach ($choices as $name => $link)
            $menudata['menudata'][] = array('menulink' => $link, 'menuname' => $name);
        return $this->parser->parse('_menubar', $menudata, true);
    }
    
    /*
     * builds the archive section of the main template.
     */
    function build_archive() {   
        $viewdata = "";
        date_default_timezone_set('America/Vancouver');
        $startdate = date('Y-m-d H:i:s');
        $tempdate = strtotime( '-8 month' , strtotime($startdate));
        $enddate = date('Y-m', $tempdate);
        
        $sql = "SELECT postID, postTitle, creationDate, enabled FROM tbl_posts "
                . "WHERE creationDate <= '" . $startdate . "' AND creationDate >= '" . $enddate . "' "
                . "ORDER BY creationDate DESC;";
        
        $data = $this->postmodel->query($sql);
        
        $archivedata = array();
        if (count($data) == 0) {
            //$archivedata['archivedata'][] = array('postid' => NULL, 'posttitle' => NULL, 'postdate' => NULL);
            for ($i = 0; $i < 8; $i++) {
                $subtract = '-' . $i . ' month';
                if ($i != 0) {
                    $curTime = date("m-Y", strtotime($subtract, strtotime($startdate)));
                    $monthTitle = date("F Y", strtotime($subtract, strtotime($startdate)));
                    $hidemonth = date("F-Y", strtotime($subtract, strtotime($startdate)));
                } else {
                    $curTime = date("m-Y", strtotime($startdate));
                    $monthTitle = date("F Y", strtotime($startdate));
                    $hidemonth = date("F-Y", strtotime($startdate));
                }
                
                if ($i != 0) {
                    $viewdata .= "<li><a href=\"javascript:void()\" onclick=\"hideMonth('" . $hidemonth . "');\">" . $monthTitle . "</a><ul class=\"daylist\" id=\"" . $hidemonth . "\" style=\"display: none;\">";
                } else {
                    $viewdata .= "<li><a href=\"javascript:void()\" onclick=\"hideMonth('" . $hidemonth . "');\">" . $monthTitle . "</a><ul class=\"daylist\" id=\"" . $hidemonth . "\">";
                }
                $viewdata .= "<li>-empty</li>";
                $viewdata .= "</ul></li>";
            }
            $archivedata['archivedata'] = $viewdata;
        } else {
            for ($i = 0; $i < 8; $i++) {
                $found = false;
                $subtract = '-' . $i . ' month';
                if ($i != 0) {
                    $curTime = date("m-Y", strtotime($subtract, strtotime($startdate)));
                    $monthTitle = date("F Y", strtotime($subtract, strtotime($startdate)));
                    $hidemonth = date("F-Y", strtotime($subtract, strtotime($startdate)));
                } else {
                    $curTime = date("m-Y", strtotime($startdate));
                    $monthTitle = date("F Y", strtotime($startdate));
                    $hidemonth = date("F-Y", strtotime($startdate));
                }
                //echo $monthTitle;
                
                if ($i != 0) {
                    $viewdata .= "<li><a href=\"javascript:void()\" onclick=\"hideMonth('" . $hidemonth . "');\">" . $monthTitle . "</a><ul class=\"daylist\" id=\"" . $hidemonth . "\" style=\"display: none;\">";
                } else {
                    $viewdata .= "<li><a href=\"javascript:void()\" onclick=\"hideMonth('" . $hidemonth . "');\">" . $monthTitle . "</a><ul class=\"daylist\" id=\"" . $hidemonth . "\">";
                }
                
                foreach ($data as $post) {
                    $date = date("F d, Y", strtotime($post['creationDate']));
                    $posttime = date("m-Y", strtotime($post['creationDate'])); 
                    if ($posttime === $curTime && $post['enabled'] == 1) {
                        //$archivedata['archivedata']['month'][] = array('postid' => $post['postID'], 'posttitle' => $post['postTitle'], 'postdate' => $date);
                        $viewdata .= "<li><a href=\"/posts?post=" . $post['postID'] . "\">" . $post['postTitle'] . " - (" . $date . ")</a></li>";
                        $found = true;
                    }
                }
                if (!$found) {
                    //$archivedata['archivedata']['month'][] = array('postid' => "", 'posttitle' => "empty", 'postdate' => "");
                    $viewdata .= "<li>-empty</li>";
                }
                $viewdata .= "</ul></li>";
            }
            $archivedata['archivedata'] = $viewdata;
        }
        return $this->parser->parse('_archive', $archivedata, true);
    }
    
    /*
     * Builds the login html for the login field section of the main template
     */
    function build_login() {
        if ($this->session->userdata('username') != NULL) {
            $login = "<div id=\"loginHeader\"><h1>User</h1></div><div id=\"loginContainer\" style=\"margin-top: -5px; margin-left: 10px;\">"
                     . "<div>Welcome - " . $this->session->userdata('username') . "</div>";
            
            $login .= "<div><a href=\"/usersettings\">Account Settings</a> &nbsp <a href=\"/newpost\">New Post</a></div>";
            
            if ($this->session->userdata('userRole') == ROLE_ADMIN) {
                $login .= "<div><div style=\"font-weight: bold; font-size: 1.2em; margin-top: 10px; margin-bottom: 5px;\">Management Functions</div><a href=\"/management\">Administration Functions</a></div>";
            }
            
            $login .= "<a href=\"/login/logout/\">"
                    . "<input type=\"button\" value=\"Logout\" style=\"width: 100px; height: 30px; margin-top: 10px; margin-bottom: 5px;\" /></a></div>";
            return $login;
        } else {
            $login = "<div id=\"loginHeader\"><h1>Login</h1></div><div id=\"loginContainer\" style=\"float: right;\">"
                     . "<form action=\"/login/submit/\" method=\"post\"><label for=\"txt-username\">Username: </label>"
                     . "<input type=\"text\" name=\"txt-username\" id=\"txt-username\" /><br /><br />"
                     . "<label for=\"txt-password\">Password: </label><input type=\"password\" name=\"txt-password\" id=\"txt-password\" />"
                     . "<br/><input type=\"submit\" value=\"Login\" id=\"btn-login\" /></form><div id=\"register\">Not a user? <a href=\"/register\">"
                     . "sign up here</a></div></div>";
            return $login;
        }
    }
    
    function restrict($roleNeeded = null) {
        // if we need a role, turn away anyone without the right role
        if ($roleNeeded != null) {
            $userRole = $this->session->userdata('userRole');
            if (!$userRole) {
                // no one is logged in, goodbye
                redirect("/");
                exit;
            }
            // logged in. check the role they have
            if (is_array($roleNeeded)) {
                if (!in_array($userRole, $roleNeeded)) {
                    // Not authorized. Redirect to home page
                    redirect("/");
                    exit;
                }
            } elseif ($userRole < $roleNeeded) {
                redirect("/");
                exit;
            }
        }
    }

}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */