<?php
    /*
     * Used for creating a new post.
     */
?>
<script>
    $(function() {
        CKEDITOR.replace('txt-content', { //creates the rich text editor for the content section.
            height: '600px',
        });
    });
    
    function ImageRepositoryDialog() {
        $.ajax({
            type: "POST",
            url: "/newpost/getImageRepository",
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
    
    function PostTagsDialog() {
        $("#posttag-dialog").dialog({
            height: 260,
            width: 250,
            modal: true
        });
    }
</script>

<div id="topic">
    New Post
</div>
<div id="topicdata">
    <div class="data">
        <form action="/newpost/submit" method="post">
            <table>
                <tr>
                    <td><label for="posttitle">Post Title:</label></td>
                    <td><input type="text" name="posttitle" id="txt-posttitle"/></td>
                </tr>
                <tr>
                    <td><label for="postdescription">Post Description:</label></td>
                    <td><input type="text" name="postdescription" id="txt-postdescription"/></td>
                </tr>
                <tr>
                    <td>Image Repository: </td>
                    <td><input type="button" value="Image Repository" onclick="ImageRepositoryDialog()"
                               style="padding: 3px;"/></td>
                </tr>
                <tr>
                    <td style="padding-bottom: 8px;"></td>
                    <td style="padding-bottom: 8px;"></td>
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
                </tr>
            </table>
            <div>
                <br/>
                <label for="txt-content">Content:</label>
                <br/>
                <textarea name="postcontent" id="txt-content"></textarea>
            </div>
            <br/>
            <div>
                <input type="submit" value="Submit Changes" />
                <a href="/">
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