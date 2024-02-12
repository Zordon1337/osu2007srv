<?php ini_set('display_errors', 0); ?>
<?php
/*
endpoint for getting leaderboard
introduced around b99
replaced by osu-getscores2.php in b162
*/
include("../utils/db.php");
$checksum = $_GET["c"];
if($all_bmaps_ranked == false)
{
    if(CheckIfBeatmapRanked($conn,$checksum))
    {
        
        ReturnScores($conn,$checksum);
    } else {
        echo "-1";
    }
}

