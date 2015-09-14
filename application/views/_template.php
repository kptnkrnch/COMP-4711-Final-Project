<?php
if (!defined('APPPATH'))
    exit('No direct script access allowed');
/**
 * view/template.php
 *
 * Pass in $pagetitle (which will in turn be passed along)
 * and $pagebody, the name of the content view.
 *
 * ------------------------------------------------------------------------
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/ico">
        <title>{title}</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <script src="/ckeditor/ckeditor.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Oxygen:400,700,300' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    </head>
    <body>
        <script>
            function hideMonth(month) {
                var temp = "#" + month;
                if ($(temp).is(":visible")) {
                    $(temp).slideUp(200, function() {
                    });
                } else {
                    $(temp).slideDown(200, function() {
                    });
                }
            }
        </script>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="/">
                        <img src="/assets/images/fossil.png" style="width: 120px; height: 120px; margin-left: 40px; margin-top: 10px;"/>
                    </a>
                </div>
                <div id="blogtitle">
                    <div id="blogname">
                        Personality Theory
                    </div>
                </div>
                <div id="navigation">
                    <div class="navitem"><a href="/">Home</a></div>
                    <div class="navitem"><a href="/links">Links</a></div>
                    <div class="navitem"><a href="/contact">Contact Us</a></div>
                    <div class="navitemEnd"><a href="/about">About</a></div>
                </div>
            </div>
            <div id="body">
                <div id="content">
                    {content}
                </div>
                <div id="posts">
                    <div id="login">
                        {login}
                    </div>
                    <div id="archive">
                        Archive
                    </div>
                    <div id="archivedata">
                        <div class="data">
                            {archive}
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">
                <div class="fdata">
                    <div class="disclaimer">
                        <!--Designed by Joshua Campbell-->
                        <a style="color: White;" href="/trends">------ XML TRENDS ------</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
