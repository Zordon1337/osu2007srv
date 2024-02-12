<?php
ini_set('display_errors', 0);

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Leaderboard</title>
    <style>
        @import url("main.css");
    </style>
</head>
<body>
    <div id='container'>
        <h2>Leaderboard</h2>
  
        <table>
        <thead>
        <tr>
            <th>Rank</th>
            <th>Username</th>
            <th>Total Score</th>
            <th>Accuracy</th>
            <th><img src="img/SS.png" height="16" width="16"/></th>
            <th><img src="img/S.png" height="16" width="16"/></th>
            <th><img src="img/A.png" height="16" width="16"/></th>
        </tr>
        </thead>
        <tbody>
<?php
include("utils/db.php");
echo RenderLeaderboard($conn);
?>