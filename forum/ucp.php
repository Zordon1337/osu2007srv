<?php ini_set('display_errors', 0); ?>
<?
/*
basically phpBB page
mostly you were redirected there to create account(/forum/ucp.php?mode=register)
first spotted in b70
*/
if(!isset($_GET['mode']))
{
    http_response_code(401);
    die();
}
$mode = $_GET['mode'];
if($mode == "register")
{
    header("location: /register.php");
    die();
}
