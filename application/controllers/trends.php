<?php

/*
 * controller for the trends view
 */
class Trends extends Application {
    function __construct() {
        parent::__construct();
        $this->load->model('mtrends');
    }
    function index() {
        $this->data['title'] = 'Trends';
        $this->data['pagebody'] = 'trends'; //obtains view template data
        $this->load->helper('display'); //loads the helper functionality
        $this->data['myxml'] = display_file('./data/xml/energy.xml'); //displays the contents of the xml file in the myxml placeholder
        $this->data['xmltable'] = $this->mtrends->BuildHTMLTable();
        $doc = new DOMDocument();
        //$doc->validateOnParse = true;
        $doc->load('./data/xml/energy.xml');
        
        $xml = XMLReader::open('./data/xml/energy.xml');
        $xml->setSchema('./data/xml/energy.xsd');
        // You must to use it
        $xml->setParserProperty(XMLReader::VALIDATE, true);
        
        libxml_use_internal_errors(true);
        if ($xml->isValid())
            $this->data['validatedxml'] = '<br/>XML Valid <br/><br/>';
        else {
            $result = "<b>ERROR</b><br/>";
            foreach (libxml_get_errors() as $error) {
                $result .= $error->message . '<br/>';
            }
            libxml_clear_errors();
            $result .= '<br/>';
            $this->data['validatedxml'] = $result;
        }
        
        $this->render(); //renders the page
    }
    
    function xsl() {
        $this->data['title'] = 'Trends XSL';
        $this->data['pagebody'] = 'vtrendsxsl'; //obtains view template data
        $this->load->helper('display'); //loads the helper functionality
        $this->data['myxml'] = display_file('./data/xml/energy.xml'); //displays the contents of the xml file in the myxml placeholder
        $this->data['xmltable'] = xsl_transform('./data/xml/energy.xml', './data/xml/energy.xsl');
        $this->data['eproduced'] = xsl_transform('./data/xml/energy.xml', './data/xml/energy2.xsl');
        $this->data['eused'] = xsl_transform('./data/xml/energy.xml', './data/xml/energy3.xsl');
        $doc = new DOMDocument();
        //$doc->validateOnParse = true;
        $doc->load('./data/xml/energy.xml');
        
        $xml = XMLReader::open('./data/xml/energy.xml');
        $xml->setSchema('./data/xml/energy.xsd');
        // You must to use it
        $xml->setParserProperty(XMLReader::VALIDATE, true);
        
        libxml_use_internal_errors(true);
        if ($xml->isValid())
            $this->data['validatedxml'] = '<br/>XML Valid <br/><br/>';
        else {
            $result = "<b>ERROR</b><br/>";
            foreach (libxml_get_errors() as $error) {
                $result .= $error->message . '<br/>';
            }
            libxml_clear_errors();
            $result .= '<br/>';
            $this->data['validatedxml'] = $result;
        }
        
        $this->render(); //renders the page
    }
}
?>
