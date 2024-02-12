<?php
session_start();   
include("utils/db.php");
if(!isset($_GET['action']))
{
    if(!isset($_GET['username'])||!isset($_GET['password']))
    {
        if(session_status() == PHP_SESSION_ACTIVE)
        {
            if(!isset($_SESSION['username'])||!isset($_SESSION['password']))
            {
                http_response_code(403);
                die();
            } else {
                if(!CheckIfCorrect($_SESSION['username'],$_SESSION['password'],$conn))
                {
                    http_response_code(403);
                    die();
                }
            }
        } else {
            http_response_code(403);
            die();
        }
    } else {
        //include("utils/db.php");
        $user = $_GET['username'];
        $pass = md5($_GET['password']);
        if(CheckIfCorrect($user,$pass,$conn))
        {
            session_start();
            $_SESSION['username']=$user;
            $_SESSION['password']=$pass;
        } else {
            Header("location:login.php");
            die();
        }
    }
} else {
    $action = $_GET['action'];
    if(session_status() == PHP_SESSION_ACTIVE)
    {
        if(!isset($_SESSION['username'])||!isset($_SESSION['password']))
        {
            http_response_code(403);
            die();
        } else {
            if(!CheckIfCorrect($_SESSION['username'],$_SESSION['password'],$conn))
            {
                http_response_code(403);
                die();
            }
        }
    }
    if($action == "changepfp")
    {
        $uploadDir = "forum/avatars/";
        $userid = GetUserIdByUsername($conn,$_SESSION['username']);
        $uploadPath = "forum/avatars/$userid.png";
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {
            Header("location: profile-settings.php");
            die();
        } else {
            Header("location: profile-settings.php");
            die();
        }
    }
}

?>

<?php ini_set('display_errors', 0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div id="container">
        <form action="/profile-settings.php?action=changepfp" method="POST" enctype="multipart/form-data"/>
        <label for="image">Choose an image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <br>
        <input type="submit" id="searchButton" value="Change profile picture">
    </form>
        <?php
        if(CheckIfAdmin($conn,$_SESSION['username']))
        {
            echo "
            <form action='newmap-handle.php' method='GET'>
            <div id='container'>
            <p>Beatmap checksum</p>
            <input name='c'/>
            
            <br/>
            <br/>
            <input type='submit' id='searchButton' value='Add beatmap to whitelist'/>
            </div>
            </form>";
        }
        ?>
    </div>
</body>
</html>
