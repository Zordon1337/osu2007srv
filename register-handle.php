<?php
include("utils/db.php");
ini_set('display_errors', 0);
if(!isset($_GET["username"]) || !isset($_GET['password']))
{
    http_response_code(401);
    die();
} else {
    $username = $_GET['username'];
    if(CheckIfUserExists($conn,$username))
    {
        http_response_code(401);
        die();
    }
    
    $password = md5($_GET['password']);
    CreateAccount($conn,$username,$password);
    Header("location: /register.php?afterregister=yes");
    die();
}

