<script>    
    $(function() {
        CKEDITOR.replace('newcomment', { //creates the rich text editor for the content section.
            height: '300px',
        });
    });
    
    function CreateComment() {
        $('#comment-box').show();
        $('#createACommentClicker').hide();
        $('#comment-box').slideDown(200, function() {
        });
    }
</script>
<div id="post-comments" style="background-color: White; width: 665px; margin-top: 12px; border: 1px solid Black; border-radius: 5px; box-shadow: 4px 4px 5px #888888">
    <h4 style="margin-left: 10px;">Comments</h4>
    <?php
    if ($comment_list != NULL) {
        foreach ($comment_list as $comment) {
    ?>
        <div class="comment-display" style="margin: 10px; padding: 10px; border: 1px solid Black; background-color: #EBEBEB">
            <?php
            if ($comment['username'] != NULL && $comment['date'] != NULL) {
            ?>
                <div style="border-bottom: 1px solid Black; margin-bottom: 5px;">
                    <h5>
                    <?php
                        echo $comment['username'] . " - " . $comment['date'];
                    ?>
                    </h5>
                </div>
            <?php
            }
            echo $comment['content'];
            ?>
        </div>
    <?php
        }
    }
    ?>
    <?php
    if ($comment_list[0]['userrole'] >= ROLE_USER) {
    ?>
        <div id="create-comment" style="margin: 10px; padding: 10px; border: 1px solid Black; background-color: #EBEBEB">
            <a href="javascript:void()" onclick="CreateComment();" id="createACommentClicker">create a comment</a>
            <div id="comment-box" style="display: none;">
                <h4>New Comment</h4>
                <form action="/comment/newcomment/<?php echo $comment_list[0]['postID']; ?>" method="post">
                    <textarea name="newcomment"></textarea>
                    <br/>
                    <input type="submit" value="Submit Comment" style="font-size: 1.2em; padding: 5px 10px 5px 10px;"/>
                </form>
            </div>
        </div>
    <?php 
    } else {
    ?>
        <div id="create-comment" style="margin: 10px; padding: 10px; border: 1px solid Black; background-color: #EBEBEB">
            You must be logged-in in order to post comments.
        </div>
    <?php 
    }
    ?>
</div>
