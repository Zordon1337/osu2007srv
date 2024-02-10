<?php
include("../utils/db.php");

/*
endpoint introduced around b130
client uses it to fetch data(ranked score, accuracy and rank)
*/
$username = $_GET['u'];
$password = $_GET['p'];
if(CheckIfCorrect($username,$password,$conn))
{
    $accuracy = GetAccuracy($conn,$username);
    $rankedscore = GetTotalScoreByUser($conn,$username);
    /*
        need to implement ranks
    */
    echo "$rankedscore|$accuracy|unknown1|unknown2|1";
}
