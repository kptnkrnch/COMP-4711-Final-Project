<?php
    /*
     * Used for displaying all posts to an admin.
     */
?>
<div id="topic">
    Edit Posts
</div>
<div id="topicdata">
    <div class="data">
        <table style="text-align: left;">
            <tr>
                <th>Post Topic</th>
                <th>Post Status</th>
                <th style="text-align: center;">Operations</th>
            </tr>
        <?php 
            foreach ($postlist as $post) {
        ?>
            <tr>
                <td>
                    <!--{postTitle}-->
                    <?php
                    echo $post['postTitle'];
                    ?>
                </td>
                <td style="text-align: center;">
                    <?php
                        if ($post['enabled'] == 1) {
                            echo "<span style=\"color: Green;\">--ACTIVE--</span>";
                        } else {
                            echo "<span style=\"color: Red;\">--INACTIVE--</span>";
                        }
                    ?>
                </td>
                <td>
                    <?php
                    //echo "<a href=\"/management/editposts/{postID}\"><input type=\"button\" value=\"Edit\" /></a>";
                    //echo "<a href=\"/management/deletepost/{postID}\"><input type=\"button\" value=\"Delete\" /></a>";
                    echo "<a href=\"/management/editposts/" . $post['postID'] . "\"><input type=\"button\" value=\"Edit\" /></a>";
                    if ($post['enabled'] == 1) {
                        echo "<a href=\"/management/deletepost/" . $post['postID'] . "\"><input type=\"button\" value=\"Deactivate\" style=\"margin-left: 5px; width: 83px;\"/></a>";
                    } else {
                        echo "<a href=\"/management/activatepost/" . $post['postID'] . "\"><input type=\"button\" value=\"Activate\" style=\"margin-left: 5px; width: 83px;\" /></a>";
                    }
                    ?>
                </td>
            </tr>
        <?php
            }
        ?>
        <!--{/postlist}-->
        </table>
    </div>
</div>


