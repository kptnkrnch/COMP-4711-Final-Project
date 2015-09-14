<?php
    /*
     * Used for updating blog info.
     */
?>
<div id="topic">
    Update Blog Info
</div>
<div id="topicdata">
    <div class="data">
        <form action="/management/UpdateBlogInfo" method="post">
            <table>
                <tr>
                    <td><label for="blogcode">Blog Code:</label></td>
                    <td><input type="text" name="blogcode" id="blogcode" value="{blogcode}"/></td>
                </tr>
                <tr>
                    <td><label for="blogname">Blog Name:</label></td>
                    <td><input type="text" name="blogname" id="blogname" value="{blogname}"/></td>
                </tr>
                <tr>
                    <td><label for="bloglink">Blog Link:</label></td>
                    <td><input type="text" name="bloglink" id="bloglink" value="{bloglink}"/></td>
                </tr>
                <tr>
                    <td><label for="blogdescription">Blog Description:</label></td>
                    <td><input type="text" name="blogdescription" id="blogdescription" value="{blogdescription}"/></td>
                </tr>
            </table>
            <div>
                <input type="submit" value="Submit Changes" />
                <a href="/management">
                    <input type="button" value="Cancel" />
                </a>
            </div>
        </form>
    </div>
</div>