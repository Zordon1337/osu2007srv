<?php

ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang=''en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Register</title>
    <style>
        @import url("main.css");
    </style>
</head>
<body>
<?php

if(isset($_GET['afterregister']))
{
    echo "thank you for registering, now join with your favorite client";
    die();
}
?>

<?php


?>


<form action="register-handle.php" method="GET">
        <div id="login-container">
            <p>Username</p>
            <input name="username"/>
            <p>password</p>
            <input name="password"/>
            <br/>
            <br/>
            <input type="submit" id="searchButton" value="Create account"/>
        </div>
</form>
</body>