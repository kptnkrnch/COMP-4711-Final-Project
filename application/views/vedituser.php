<?php
    /*
     * Used for allowing an admin to edit a user.
     */
?>
<script>
    $(function() {
        $("#txt-creationdate").datepicker(); //creates the date picker widget for the creation date field
        $("#txt-lastupdated").datepicker(); //creates the date picker widget for last updated field
    });
</script>
<div id="topic">
    Edit User - {username}
</div>
<div id="topicdata">
    <div class="data">
        <form action="/management/updateuser/{userid}" method="post">
            <table>
                <tr>
                    <td><label for="txt-username">Username:</label></td>
                    <td><input type="text" name="txt-username" id="txt-usernm" value="{username}"/></td>
                </tr>
                <tr>
                    <td><label for="txt-password">Password:</label></td>
                    <td><input type="password" name="txt-password" id="txt-passwrd"/></td>
                </tr>
                <tr>
                    <td><label for="txt-cpassword">Confirm Password:</label></td>
                    <td><input type="password" name="txt-cpassword" id="txt-cpasswrd"/></td>
                </tr>
                <tr>
                    <td><label for="txt-firstname">First Name:</label></td>
                    <td><input type="text" name="txt-firstname" id="txt-firstname" value="{firstname}"/></td>
                </tr>
                <tr>
                    <td><label for="txt-lastname">Last Name:</label></td>
                    <td><input type="text" name="txt-lastname" id="txt-lastname" value="{lastname}"/></td>
                </tr>
                <tr>
                    <td><label for="txt-email">Email:</label></td>
                    <td><input type="text" name="txt-email" id="txt-email" value="{email}"/></td>
                </tr>
                <tr>
                    <td><label for="txt-creationdate">Creation Date:</label></td>
                    <td><input type="text" name="txt-creationdate" id="txt-creationdate" value="{creationDate}" /></td>
                </tr>
                <tr>
                    <td><label for="txt-lastupdated">Last Updated:</label></td>
                    <td><input type="text" name="txt-lastupdated" id="txt-lastupdated" value="{lastUpdate}"/></td>
                </tr>
                <tr>
                    <td><label for="txt-privilege">Privilege:</label></td>
                    <td><!--<input type="text" name="txt-privilege" id="txt-privilege" value="{privilege}"/>-->
                        <select name="txt-privilege" id="txt-privilege">
                            <option value="2" <?php if ($privilege == ROLE_VISITOR) { echo "selected=\"selected\""; } ?>>Visitor</option>
                            <option value="3" <?php if ($privilege == ROLE_USER) { echo "selected=\"selected\""; } ?>>Standard User</option>
                            <option value="4" <?php if ($privilege == ROLE_ADMIN) { echo "selected=\"selected\""; } ?>>Administrator</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="txt-enabled">Enabled:</label></td>
                    <td><input type="text" name="txt-enabled" id="txt-enabled" value="{enabled}"/></td>
                </tr>
            </table>
            <br/>
            <div>
                <input type="submit" value="Submit Changes" />
                <a href="/management/editusers">
                    <input type="button" value="Cancel" />
                </a>
            </div>
        </form>
    </div>
</div>


