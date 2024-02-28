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

if($latest_version > 69)
{
    if(CheckIfCorrect($username,$password,$conn))
    {
        echo "1";
    } else {
        echo "0";
    }

}