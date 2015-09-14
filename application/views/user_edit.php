<?php
    /*
     * unused
     */
?>
<div class="section">
    <br />
    <form action="/usermtce/submit/{userID}" method="post">
        <label for="id">ID</label>
        <input type="text" name="userID" id="userID" value="{userID}"/>
        <br />
        <label for="username">User Name</label>
        <input type="text" name="username" id="username" value="{username}"/>
        <br />
        <label for="password">Password</label>
        <input type="text" name="password" id="password" value="{password}"/>
        <br />
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" value="{firstname}"/>
        <br />
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" value="{lastname}"/>
        <br />
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{email}"/>
        <br />
        <label for="privilege">Privilege</label>
        <input type="text" name="privilege" id="privilege" value="{privilege}"/>
        <br />
        <label for="enabled">Enabled</label>
        <input type="text" name="enabled" id="enabled" value="{enabled}"/>
        <input type="hidden" name="creationDate" id="creationDate" value="{creationDate}" />
        <br/><br/>
        <button type="submit">Submit</button>
        <a href="/usermtce"><input type="button" value="Cancel"></input></a>
    </form>
</div>
