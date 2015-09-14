<?php
    /*
     * unused.
     */
?>
<div class="section">
    <table cols="" border="0">
        <tr>
            <th>Action</th>
            <th>ID</th>
            <th>Username</th>
            <th>Role-level</th>
            <th>Email</th>
        </tr>
        {users} <?php /*Loads the contact data into the placeholders below*/?>
        <tr>
            <td>
                <a href="/usermtce/edit/{userID}">edit</a>
                <a href="/usermtce/delete/{userID}">delete</a>
            </td>
            <td>{userID}</td>
            <td>{username}</td>
            <td>{privilege}</td>
            <td>{email}</td>
        </tr>
        {/users}
    </table>
    <br />
    <a href="usermtce/add">Add User</a>
</div>
