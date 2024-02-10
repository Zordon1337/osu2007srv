<?php
include("../utils/db.php");
$checksum = $_GET["c"];
if(CheckIfBeatmapRanked($conn,$checksum))
{
    ReturnScores($conn,$checksum);
} else {
    echo "-1";
}


