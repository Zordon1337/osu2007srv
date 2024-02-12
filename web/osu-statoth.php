<?php ini_set('display_errors', 0); ?>
<?php
include("../utils/db.php");

/*
endpoint introduced in b222 replacing osu-stat.php
client uses it to fetch data(ranked score, accuracy and rank)
the only diffrence beetwen osu-stat.php and osu-statoth.php
is that the newer one sends checksum instead of password
*/
$username = $_GET['u'];
$accuracy = GetAccuracy($conn,$username);
$rankedscore = GetTotalScoreByUser($conn,$username);
$pfpid = GetPfp($conn,$username);
$rank = GetRank($conn,$username);
echo "$rankedscore|$accuracy|unknown1|unknown2|$rank|$pfpid";