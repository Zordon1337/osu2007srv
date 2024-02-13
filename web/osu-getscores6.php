<?php ini_set('display_errors', 0); ?>
<?php
/*
experimental endpoint for b504
*/
include("../utils/db.php");
include("../utils/config.php");
if($b504_experiment == true)
{
    $checksum = $_GET["c"];
    $filename = $_GET["f"];
    if(CheckIfBeatmapRanked($conn,$checksum))
    {
        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";
        ReturnScores5($conn,$checksum);
       
    } else {
        echo "0";
    }
    
}

