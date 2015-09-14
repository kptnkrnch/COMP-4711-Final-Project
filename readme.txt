COMP 4711 Assignment 2
By Josh Campbell

Blog title: Personality Theory

This blog is meant to be a source for information regarding different personality 
theories. The goal of this blog is to provide topics and then spur discussion with
users of the site on said topics. The target audience is anyone who is interested
in understanding themselves or others.

Each post will be categorized by the date it was posted and what personality
theory it covers.

--------------------------------------------------------------------------------
Updates:

Assignment 03 ----------------------------------------------------
    * added in pivoted trends tables to the /trends/xsl page.
    * added in two new xsl files, energy2.xsl and energy3.xsl in
      the data/xml folder.
    * added in user comments, they are available to anyone who
      signs up.
    * I linked my site on facebook to my friends and family, so a
      majority of the comments are not my own, but actual users.
    * All of my blog posts are done by my alias, kptnkrnch. Any
      extra posts that might appear are not my own. If there are
      other posts, it is because one of my goals of creating a
      community driven blog is being met.
------------------------------------------------------------------

Lab 10 -----------------------------------------------------------
    * trends.php in controllers contains the controller info
    * trends.php in views contains the regular table
    * vtrendsxsl.php in views contains the xsl table
    * energy.xml in the data/xml folder is the xml document
    * energy.xsl in the data/xml folder is the xsl style document
        * link to the trends page is found in the footer
        * link to the trends xsl page is found on the regular
          trends page. If unable to find the link, the hard link
          is /trends/xsl
------------------------------------------------------------------

Lab 9 ------------------------------------------------------------
    * trends.php in controllers contains the controller info
    * trends.php in views contains the display info
    * energy.xml in the data/xml folder is the xml document
    * energy.xsd in the data/xml folder is the schema document
	* link to the trends page is found in the footer
------------------------------------------------------------------

Lab 8 ------------------------------------------------------------
    * capo.php in controllers contains the RPC server
    * management.php in controllers contains the blog update info
      client. uses notifySyndicate, UpdateBlogInfo, and 
      EditBlogInfo (the view).
    * newpost.php in controller contains the post update client.
      Functionality is in notifySyndicate and submit.
------------------------------------------------------------------

--------------------------------------------------------------------------------

Functions in place so far:
 
-Webpage framework is almost complete.
-Archive section is functional (needs to be hooked up to the database).
-Navbar links to the appropriate views (using appropriate controllers).
-Posts are generated using content from the database.
-Admins can edit users, posts, and images.
-Users can create posts.
-Users can edit their posts.
-People can register for a user account.
-Pagination on posts is working.
-Pagination for image dialog box is working.
-Image submission is working.
-Tag sorting is working.
-Login/logout is working.
-Archive is functional.

--------------------------------------------------------------------------------

Database schema:

There are a total of 9 tables so far including:
	a user table
	a post table
	a comments table
	an image table
	a categories table
	a contact us table
        a sessions table
        a post tag table
        a roles table

User, post, image, sessions, and post tags tables are in use.

--------------------------------------------------------------------------------

Models:

Seven models have been made (one for each of the database tables except roles and 
sessions) and are associated with their respective table. Postmodel, Posttags 
model, images model, and users model are currently in use.

--------------------------------------------------------------------------------

Controllers & Views:

The following table summarizes what controller & view is used for each page:

Page                | Controller          | View
--------------------------------------------------------------------------------
Front page          | welcome.php         | welcome.php
Post                | posts.php           | posts.php
About               | about.php           | about.php
Contact Us          | contact.php         | contact.php
Links               | links.php           | links.php
Register            | register.php        | register.php
Management          | management.php      | vmanagement.php
Admin Edit Posts    | management.php      | veditpost.php and veditposts.php
Admin Edit Users    | management.php      | vedituser.php and veditusers.php
User settings       | usersettings.php    | vusersettings.php
User Edit Posts     | usersettings.php    | vedituserpost.php 
                                          | and vedituserposts.php
List tag posts      | posts.php           | vlistposts.php


Notes:
-Post pages make use of url string variables and the posts database table
 in order to generate the post pages.
-About, Contact Us, and Links currently do not have any content.

--------------------------------------------------------------------------------

Other notes:

-This blog layout was a custom layout designed by myself in order to give me more
 freedom when designing my blog. It also got me fully acquainted with the structure
 of the html as well as the CSS.
 
-Images are located in the /assets/images folder

-User images are located in /assets/images/userimages
