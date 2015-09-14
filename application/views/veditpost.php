<?php
    /*
     * used for allowing an admin to edit a post.
     */
?>
<script>
    $(function() {
        $("#txt-creationdate").datepicker({ dateFormat: 'yy-mm-dd' }); //creates the date picker widget for the creation date field
        $("#txt-lastupdated").datepicker({ dateFormat: 'yy-mm-dd' }); //creates the date picker widget for last updated field
        CKEDITOR.replace('txt-content', { //creates the rich text editor for the content section.
            height: '600px',
        });
    });
    /*Gets image data for image repository dialog box.*/
    function ImageRepositoryDialog() {
        $.ajax({
            type: "POST",
            url: "/management/getImageRepository",
            data: { page: 1 },
            dataType: "html"
        }).done(function(data){ 
            $("#imagerepository-dialog").html(data);
            $("#imagerepository-dialog").show();
            $("#imagerepository-dialog").dialog({
                height: 750,
                width: 400,
                modal: true
            });
        });
    }
    /*Displays the post tag dialog options box.*/
    function PostTagsDialog() {
        $("#posttag-dialog").dialog({
            height: 260,
            width: 250,
            modal: true
        });
    }
</script>
<div id="topic">
    Edit Post - {postTitle}
</div>
<div id="topicdata">
    <div class="data">
        <form action="/management/updatepost/{postID}" method="post">
            <table>
                <tr>
                    <td><label for="txt-userid">User ID:</label></td>
                    <td><input type="text" name="txt-userid" id="txt-userid" value="{userID}"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="txt-categoryid">Category ID:</label></td>
                    <td><input type="text" name="txt-categoryid" id="txt-categoryid" value="{categoryID}"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="txt-posttitle">Post Title:</label></td>
                    <td><input type="text" name="txt-posttitle" id="txt-posttitle" value="{postTitle}"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="txt-creationdate">Creation Date:</label></td>
                    <td><input type="text" name="txt-creationdate" id="txt-creationdate" value="{creationDate}" /></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="txt-lastupdated">Last Updated:</label></td>
                    <td><input type="text" name="txt-lastupdated" id="txt-lastupdated" value="{lastUpdate}"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="txt-enabled">Enabled:</label></td>
                    <td><input type="text" name="txt-enabled" id="txt-enabled" value="{enabled}"/></td>
                    <td><input type="button" value="Image Repository" onclick="ImageRepositoryDialog()"
                               style="margin-top: -10px; padding: 3px; margin-left: 100px;"/></td>
                </tr>
                <tr>
                    <td>Post Tags: </td>
                    <td>
                        <input type="button" id="txt-posttags" value="Set Tags" onclick="PostTagsDialog()"/>
                        
                        <input type="hidden" id="txt-mbtitag" name="txt-mbtitag" value="0" />
                        <input type="hidden" id="txt-big5tag" name="txt-big5tag" value="0" />
                        <input type="hidden" id="txt-enneagramtag" name="txt-enneagramtag" value="0" />
                        <input type="hidden" id="txt-socionicstag" name="txt-socionicstag" value="0" />
                        <input type="hidden" id="txt-cogfunctag" name="txt-cogfunctag" value="0" />
                        <input type="hidden" id="txt-charactertag" name="txt-charactertag" value="0" />
                    </td>
                    <td></td>
                </tr>
            </table>
            <div>
                <label for="txt-content">Content:</label>
                <textarea name="txt-content" id="txt-content">{postcontent}</textarea>
            </div>
            <br/>
            <div>
                <input type="submit" value="Submit Changes" />
                <a href="/management/editposts">
                    <input type="button" value="Cancel" />
                </a>
            </div>
        </form>
    </div>
</div>

<div id="imagerepository-dialog" title="Images" style="display: none;">
</div>

<div id="posttag-dialog" title="Post Tags" style="display: none;">
    {posttags}
</div>


