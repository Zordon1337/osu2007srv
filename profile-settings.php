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
        $uploadPath = "forum/avatars/$userid.jpg";
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {
            include("utils/utils.php");
            ConvertTo128By128($uploadPath);
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
    <title>Settings</title>
    <style>
        @import url("main.css");
    </style>
</head>
<body>
    <div id="container">
        <form action="/profile-settings.php?action=changepfp" method="POST" enctype="multipart/form-data"/>
        <label for="image">Choose an image(must be 128x128 or it will be bugged in client):</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <br>
        <input type="submit" id="searchButton" value="Change profile picture">
    </form>
        <?php
        if(CheckIfAdmin($conn,$_SESSION['username']))
        {
            echo "
            <br/>
            <br/>
            <form action='newmap-handle.php' method='GET'>
            <div>
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
