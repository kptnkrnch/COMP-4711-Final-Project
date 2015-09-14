<?php

/*
 * controller for the posts view
 */
class Capo extends Application {
    function __construct() {
        parent::__construct();
        $this->load->model('bloginfo');
        $this->load->model('postmodel'); //loads the posts model
        $this->load->library('xmlrpc');
        $this->load->library('xmlrpcs');
    }
    function index() {
        $config['functions']['capo.info'] = array('function' => 'Capo.info');
        $config['functions']['info'] = array('function' => 'Capo.info');
        $config['functions']['capo.latest'] = array('function' => 'Capo.latest');
        $config['functions']['latest'] = array('function' => 'Capo.latest');
        $config['functions']['capo.posts'] = array('function' => 'Capo.posts');
        $config['functions']['posts'] = array('function' => 'Capo.posts');
        $config['functions']['capo.post'] = array('function' => 'Capo.post');
        $config['functions']['post'] = array('function' => 'Capo.post');
        $config['object'] = $this;

        $this->xmlrpcs->initialize($config);
        $this->xmlrpcs->serve();
    }
    
    function info() {
        $data = $this->bloginfo->get(1);
        
        $answer = array(
            array('code' => array($data->code, 'string')),
            array('name' => array($data->name, 'string')),
            array('link' => array($data->link, 'string')),
            array('slug' => array($data->plug, 'string'))
        );
        
        $response = array();
        foreach ($answer as $row) {
            $response[] = array($row, 'struct');
        }
        $response = array($response, 'struct');
        
        return $this->xmlrpc->send_response($response);
    }
    
    function latest() {
        $latest = $this->postmodel->getLastActivePost();
        $bloginfo = $this->bloginfo->get(1);
        
        $link = $bloginfo->link . '/posts?post=' . $latest['postID'];
        
        $slug = "";
        if ($latest['description'] == NULL || strlen($latest['description']) == 0) {
            $slug = "No Slug Available";
        } else {
            $slug = $latest['description'];
        }
        
        $answer = array(
            array('code' => $bloginfo->code),
            array('id' => $latest['postID']),
            array('datetime' => $latest['creationDate']),
            array('link' => $link),
            array('title' => $latest['postTitle']),
            array('slug' => $slug)
        );
        
        $response = array();
        foreach ($answer as $row)
            $response[] = array($row, 'struct');
        $response = array($response, 'struct');

        return $this->xmlrpc->send_response($response);
    }
    
    function posts() {
        $data = $this->postmodel->getAll_array();
        $bloginfo = $this->bloginfo->get(1);
        $answer = array();
        foreach($data as $postrow) {
            $link = $bloginfo->link . '/posts?post=' . $postrow['postID'];

            $slug = "";
            if ($postrow['description'] == NULL || strlen($postrow['description']) == 0) {
                $slug = "No Slug Available";
            } else {
                $slug = $postrow['description'];
            }

            $post = array(
                'code' => $bloginfo->code,
                'id' => $postrow['postID'],
                'datetime' => $postrow['creationDate'],
                'link' => $link,
                'title' => $postrow['postTitle'],
                'slug' => $slug
            );
            $answer[] = array($post, 'struct');
        }
        
        $response = array();
        $response = array($answer, 'struct');

        return $this->xmlrpc->send_response($response);
    }
    
    function post($id) {
        $data = $this->postmodel->get(2);
        $bloginfo = $this->bloginfo->get(1);
        
        $link = $bloginfo->link . '/posts?post=' . $data->postID;
        
        $slug = "";
        if ($data->description == NULL || strlen($data->description) == 0) {
            $slug = "No Slug Available";
        } else {
            $slug = $data->description;
        }
        
        $answer = array(
            array('code' => $bloginfo->code),
            array('id' => $data->postID),
            array('datetime' => $data->creationDate),
            array('link' => $link),
            array('title' => $data->postTitle),
            array('slug' => $slug)
        );
        
        $response = array();
        foreach ($answer as $row)
            $response[] = array($row, 'struct');
        $response = array($response, 'struct');

        return $this->xmlrpc->send_response($response);
    }
}
?>
