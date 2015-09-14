<?php
/*
 * contacts model, associates with the contacts table in the DB
 */
class mTrends {
    // Constructor
    function __construct() {
        
    }
    
    function BuildHTMLTable() {
        $xml = simplexml_load_file("./data/xml/energy.xml");
        $result = array();
        $table = "<table><tr><th></th>";
        $eproduced = $xml->ENERGYPRODUCED;
        $eused = $xml->ENERGYUSED;
        $residential = $eused->RESIDENTIAL;
        $industrial = $eused->INDUSTRIAL;
        
        foreach($eproduced->TYPE->YEAR as $year) {
            foreach($year->attributes() as $name => $yearattr) {
                $table .= "<th style=\"text-align: left; padding-left: 10px; padding-right: 10px;\">" . $yearattr . "</th>";
            }
        }
        $table .= "</tr><tr>";
        foreach($eproduced->TYPE as $type) {
            foreach($type->attributes() as $name => $source) {
                $table .= "<th style=\"text-align: left;\">" . $source . "</th>";
            }
            foreach($type->YEAR as $year) {
                foreach($year->ENERGY as $joules) {
                    $table .= "<td style=\"text-align: left; padding-left: 10px; padding-right: 10px;\">" . $joules . "</td>";
                }
            }
            $table .= "</tr><tr>";
        }
        foreach($residential->TYPE as $type) {
            foreach($type->attributes() as $name => $source) {
                $table .= "<th style=\"text-align: left;\">" . $source . "</th>";
            }
            foreach($type->YEAR as $year) {
                foreach($year->ENERGY as $joules) {
                    $table .= "<td style=\"text-align: left; padding-left: 10px; padding-right: 10px;\">" . $joules . "</td>";
                }
            }
            $table .= "</tr><tr>";
        }
        foreach($industrial->TYPE as $type) {
            foreach($type->attributes() as $name => $source) {
                $table .= "<th style=\"text-align: left;\">" . $source . "</th>";
            }
            foreach($type->YEAR as $year) {
                foreach($year->ENERGY as $joules) {
                    $table .= "<td style=\"text-align: left; padding-left: 10px; padding-right: 10px;\">" . $joules . "</td>";
                }
            }
            $table .= "</tr><tr>";
        }
        
        
        $table .= "</tr></table>";
        //foreach($)
        return $table;
    }
}
?>

