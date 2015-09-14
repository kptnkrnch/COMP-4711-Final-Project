<?php
    /*
     * Used for registering a new user.
     */
?>
<div id="content">
    <div id="topic" style="width: 650px;">
        Register
    </div>
    <div id="topicdata" style="width: 99%;">
        <div class="data">
            <form action="/register/submit/" method="post">
                <table>
                    <tr>
                        <td>
                            <label for="txt-username">User Name:</label>
                        </td>
                        <td>
                            <input type="text" name="txt-username" class="txt-username"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txt-password">Password:</label>
                        </td>
                        <td>
                            <input type="password" name="txt-password" class="txt-password"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txt-cpassword">Confirm Password:</label>
                        </td>
                        <td>
                            <input type="password" name="txt-cpassword" class="txt-cpassword"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txt-firstname">First Name:</label>
                        </td>
                        <td>
                            <input type="text" name="txt-firstname" class="txt-firstname"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txt-lastname">Last Name:</label>
                        </td>
                        <td>
                            <input type="text" name="txt-lastname" class="txt-lastname"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txt-email">Email:</label>
                        </td>
                        <td>
                            <input type="text" name="txt-email" class="txt-email"/>
                        </td>
                    </tr>
                </table>
                <!--<label for="txt-privilege">Privilege</label>
                <input type="text" name="txt-privilege" id="txt-privilege"/>
                <input type="hidden" name="enabled" id="enabled" value="1"/>-->
                <br/><br/>
                <button type="submit" style="width: 80px; height: 30px;">Submit</button>
                <a href="/"><input type="button" value="Cancel" style="width: 80px; height: 30px;"></input></a>
            </form>
        </div>
    </div>
</div>