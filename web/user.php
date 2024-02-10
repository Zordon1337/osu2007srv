<?php
include("../utils/config.php");
/*
login endpoint used in b70

*/
if(!isset($_GET['username']) || !isset($_GET['password']))
{
    http_response_code(401);
    die();
}
$username = $_GET['username'];
$password = $_GET['password']; // md5 hash
if($username == $default_user && $password == $default_pass)
{
    echo "1"; // correct password and username
} else {
    echo "0"; // wrong password or username
}
?>