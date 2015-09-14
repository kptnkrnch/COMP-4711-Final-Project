<?php
/*
 * Images model, associates with the "tbl_images" table in the DB
 */
class Images extends _Mymodel {
    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tbl_images', 'imageID');
    }
    
    function getImages($page) {
        $limit = $page - 1 * 40; 
        $sql = "";
        if ($page == 1) {
        $sql = "SELECT * FROM tbl_images ORDER BY creationDate DESC LIMIT " . 
                ($page * 40);
        } else {
            $sql = "SELECT * FROM tbl_images ORDER BY creationDate DESC LIMIT " . 
                ($page * 40) . " MINUS " .
                "SELECT * FROM tbl_images ORDER BY creationDate DESC LIMIT " .
                $limit;
        }
        $result = $this->query($sql);
        $imagerepository = array();
        for ($i = 0, $ndone = true; $i < 8 && $ndone; $i++) {
            $imagerow = array();
            if (count($result) < ($i)) {
                $ndone = false;
            }
            for ($n = 0; $n < 5 && $ndone; $n++) {
                if (count($result) > (5 * $i + $n)) {
                    $image = $result[(5 * $i + $n)]["imagename"];
                    $imageid = $result[(5 * $i + $n)]["imageID"];
                    $imagerow[$n] = array("imagename" => $image, "imageid" => $imageid);
                } else {
                    $ndone = false;
                }
            }
            $imagerepository[$i] = $imagerow;
        }
        return $imagerepository;
    }
    
    function insertImage($userID, $imageName) {
        $image = $this->create();
        $image->userID = $userID;
        $image->imagename = $imageName;
        date_default_timezone_set('America/Vancouver');
        $mysqldate = date('Y-m-d H:i:s');
        $image->creationDate = $mysqldate;
        $this->add($image);
    }
    
    function getImageRepository($page) {
        $sql = "SELECT * FROM tbl_images ORDER BY creationDate DESC LIMIT " . 
                (($page - 1) * 9) . ", 9;";
        
        $result = $this->query($sql);
        if ($result != NULL) {
            $imagerepository = array();
            for ($i = 0, $ndone = true; $i < 3 && $ndone; $i++) {
                $imagerow = array();
                if (count($result) < ($i * 3)) {
                    $ndone = false;
                    break;
                }
                for ($n = 0; $n < 3 && $ndone; $n++) {
                    if (count($result) > (3 * $i + $n)) {
                        $image = $result[(3 * $i + $n)]["imagename"];
                        $imagerow[$n] = $image;
                    } else {
                        $ndone = false;
                    }
                }
                $imagerepository[] = $imagerow;
            }
            return $imagerepository;
        } else {
            return NULL;
        }
    }
    
    function deleteImage($imageid) {
        $this->delete($imageid);
    }
    
    function findImage($imagename) {
        $sql = "SELECT * FROM tbl_images WHERE imagename = '" . $imagename . "';";
        //echo $sql . "\n";
        $result = $this->query($sql);
        if ($result == null) {
            return false;
        } else if (count($result) == 0) {
            return false;
        }
        return true;
    }
}
?>
