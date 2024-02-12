<?php

ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang=''en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Login</title>
    <style>
         @import url("main.css");
    </style>
</head>
<body>
<?php
include("utils/db.php");
session_start();
InitDB($conn);
?>

<?php

if(isset($_SESSION['password']))
{
    Header("location: profile-settings.php");
    die();
}
?>


<form action="profile-settings.php" method="GET">
        <div id="container">
            <p>Username</p>
            <input name="username"/>
            <p>password</p>
            <input name="password"/>
            <br/>
            <br/>
            <input type="submit" id="searchButton" value="Login"/>
        </div>
</form>
</body>