<?php

if(isset($_GET['afterregister']))
{
    echo "thank you for registering, now join with your favorite client";
    die();
}
?>

<form action="register-handle.php" method="GET">
        <div style="text-align:center;vertical-align:middle;color:white;background-color:black">
            <p>Username</p>
            <input name="username"/>
            <p>password</p>
            <input name="password"/>
            <br/>
            <br/>
            <input type="submit" value="Create account"/>
        </div>
</form>