<?php
    /*
     * Used for displaying a list of all users that an admin can edit.
     */
?>
<div id="topic">
    Edit Users
</div>
<div id="topicdata">
    <div class="data">
        <table style="text-align: left;">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Operations</th>
            </tr>
        {userlist}
            <tr>
                <td>
                    {username}
                </td>
                <td>
                    {email}
                </td>
                <td>
                    <a href="/management/editusers/{userID}">
                        <input type="button" value="Edit" />
                    </a>
                    <a href="/management/deleteuser/{userID}">
                        <input type="button" value="Delete" />
                    </a>
                </td>
            </tr>
        {/userlist}
        </table>
    </div>
</div>


