<?php ini_set('display_errors', 0); ?>
<?php
$checksum = $_GET['c'];
$fileName = $checksum.".osr";
$filePath = "../replays/$fileName";
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $fileName);
header('Content-Length: ' . filesize($filePath));
readfile($filePath);

/*

you need to implement it yourself, cuz the checksum sent i actually rank in leaderboard not the checksum, since finding with id is harder than with checksum im not planning to do that
*/
