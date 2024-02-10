<?php
include("../utils/config.php");
include("../utils/db.php");
/*
login endpoint introduced somewhere around b99
it is used to last php server version(b222)
*/
if(!isset($_GET['username']) || !isset($_GET['password']))
{
    http_response_code(401);
    die();
}
$username = $_GET['username'];
$password = $_GET['password']; // md5 hash

if(CheckIfCorrect($username,$password,$conn))
{
    echo "1";
} else {
    echo "0";
}
