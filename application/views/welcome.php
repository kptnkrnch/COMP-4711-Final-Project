<?php
    /*
     * Homepage, displays the most recent post.
     */
?>
<div id="topic">
    {posttitle}
</div>
<div id="topicdata">
    <div class="data">
        <div style="float: right;">
            Posted by {username}
            <br/>
            Date: {creationdate}
        </div>
        <br/><br/><hr style="border-color: Grey"/>
        <div>
            {postdata}
        </div>
    </div>
</div>
{commentsection}
<?php
    if ($tags != NULL && count($tags) > 0) {
?>
    <div id="post-tags"  style="background-color: White; width: 665px; margin-top: 12px; border: 1px solid Black; border-radius: 5px; box-shadow: 4px 4px 5px #888888">
        <div style="margin: 8px; text-align: center;">
            <div style="text-align: left;">
                <h4>&nbsp;tags:</h4>
            </div>
        <?php
            foreach ($tags as $tag) {
        ?>
                <a href="posts/postlist/<?php echo $tag['value'] ?>">
                    <?php
                        if ($tag['value'] == $values['mbti']) {
                            echo "-MBTI- &nbsp;";
                        } else if ($tag['value'] == $values['big5']) {
                            echo "-Big Five- &nbsp;";
                        } else if ($tag['value'] == $values['enneagram']) {
                            echo "-Enneagram- &nbsp;";
                        } else if ($tag['value'] == $values['socionics']) {
                            echo "-Socionics- &nbsp;";
                        } else if ($tag['value'] == $values['cogfunc']) {
                            echo "-Cognitive Functions- &nbsp;";
                        } else if ($tag['value'] == $values['character']) {
                            echo "-Character Analysis- &nbsp;";
                        } else {
                            echo "-ERROR- ";
                        }
                    ?>
                </a>
        <?php
            }
        ?>
        </div>
    </div>
<?php
    }
?>
<div id="post-navigation" style="background-color: White; width: 665px; margin-top: 12px; border: 1px solid Black; border-radius: 5px; box-shadow: 4px 4px 5px #888888">
    <ul style="list-style-type: none; text-align: center; margin: 5px;">
        <li style="display: inline;"><a href="/posts?post=<?php echo $firstpost; ?>">First</a></li>
        &nbsp;
        <li style="display: inline;"><a href="/posts?post=<?php echo $prevpost; ?>"><< Previous</a></li>
        &nbsp;&nbsp;
        <li style="display: inline;"><a href="/posts?post=<?php echo $nextpost; ?>">Next >></a></li>
        &nbsp;
        <li style="display: inline;"><a href="/posts?post=<?php echo $lastpost; ?>">Last</a></li>
    </ul>
</div>