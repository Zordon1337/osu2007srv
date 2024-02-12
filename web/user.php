<?php ini_set('display_errors', 0); ?>
<?php
include("../utils/config.php");
include("../utils/db.php");
/*
login endpoint used in b70
replaced in b99 to osu-login.php
*/
if(!isset($_GET['username']) || !isset($_GET['password']))
{
    http_response_code(401);
    die();
}
$username = $_GET['username'];
$password = $_GET['password']; // md5 hash
/*if($username == $default_user && $password == $default_pass)
{
    echo "1"; // correct password and username
} else {
    echo "0"; // wrong password or username
}*/

if(CheckIfCorrect($username,$password,$conn))
{
    echo "1";
} else {
    echo "0";
}
