<?php
    /*
     * unused
     */
?>
<div class="section">
    <br />
    <form action="/usermtce/submit/" method="post">
        <label for="username">User Name</label>
        <input type="text" name="username" id="username"/>
        <br />
        <label for="password">Password</label>
        <input type="text" name="password" id="password"/>
        <br />
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname"/>
        <br />
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname"/>
        <br />
        <label for="email">Email</label>
        <input type="text" name="email" id="email"/>
        <br />
        <label for="privilege">Privilege</label>
        <input type="text" name="privilege" id="privilege"/>
        <input type="hidden" name="enabled" id="enabled" value="1"/>
        <br/><br/>
        <button type="submit">Submit</button>
        <a href="/usermtce"><input type="button" value="Cancel"></input></a>
    </form>
</div>
