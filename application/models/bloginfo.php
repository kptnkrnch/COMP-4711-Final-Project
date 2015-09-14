<?php
/*
 * bloginfo model, associates with the contacts table in the DB
 */
class BlogInfo extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tbl_blogdescriptor', 'id');
    }
    
    function UpdateBlogInfo($code, $name, $link, $description) {
        $bloginfo = $this->get(1);
        $bloginfo->code = $code;
        $bloginfo->name = $name;
        $bloginfo->link = $link;
        $bloginfo->plug = $description;
        $this->update($bloginfo);
    }
    
}
?>
