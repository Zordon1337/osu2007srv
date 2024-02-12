<?php

ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang=''en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>osu2007srv</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #container {
            border: 2px solid #000000;
            padding: 20px;
            text-align: center;
        }

        #playerNameLabel {
            display: block;
            margin-bottom: 10px;
        }

        #playerNameInput {
            width: 200px;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        #searchButton {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        #searchButton:hover {
            background-color: #45a049;
        }
        #playerInfo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
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