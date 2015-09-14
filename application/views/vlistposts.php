<?php
    /*
     * Lists all posts of a certain tag type.
     */
?>
<div id="topic">
    Posts - {tagtype}
</div>
<div id="topicdata">
    <div class="data">
        <table style="text-align: left;">
            <tr>
                <th style="padding-right: 30px;">Post Topic</th>
                <th>Post Date</th>
            </tr>
            <?php 
                foreach ($postlist as $post) {
            ?>
                    <tr>
                        <td style="padding-right: 30px;">
                            <a href="/posts?post=<?php echo $post['postID'] ?>">
                                <?php echo $post['postTitle']; ?>
                            </a>
                        </td>
                        <td>
                            <?php
                                echo $post['creationDate'];
                            ?>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>