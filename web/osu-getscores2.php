<?php ini_set('display_errors', 0); ?>
<?php
/*
endpoint for getting leaderboard
introduced around b162
*/
include("../utils/db.php");
$checksum = $_GET["c"];
$filename = $_GET["f"];
if(CheckIfBeatmapRanked($conn,$checksum))
{
    
    ReturnScores2($conn,$checksum);
} else {
    echo "0";
}


