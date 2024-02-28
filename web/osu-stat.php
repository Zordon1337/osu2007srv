<?php ini_set('display_errors', 0); ?>
<?php
include("../utils/db.php");
include("../utils/config.php");
/*
endpoint introduced around b130
client uses it to fetch data(ranked score, accuracy and rank)
replaced in b22 to osu-statoth.php
*/
if($latest_version > 129)
{
    $username = $_GET['u'];
    $password = $_GET['p'];
    if(CheckIfCorrect($username,$password,$conn))
    {
        $accuracy = GetAccuracy($conn,$username);
        $rankedscore = GetTotalScoreByUser($conn,$username);
        $pfpid = GetPfp($conn,$username);
        $rank = GetRank($conn,$username);
        echo "$rankedscore|$accuracy|unknown1|unknown2|$rank|$pfpid";
    }
}
