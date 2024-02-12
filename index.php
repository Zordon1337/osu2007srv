<?php ini_set('display_errors', 0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>osu2007srv</title>
    <style>
        @import url("main.css");
    </style>
</head>
<body>
    <div id="container">
        <form action="/profile.php" method="GET"/>
        <h1>osu!2007</h1>
<?php
include("utils/db.php");
$d1 = GetPlayersAmount($conn);
$d2 = GetTotalPlayCount($conn);
echo "<p>Currently serving $d1 players,<br/> with total of $d2 plays</p>"
?>
        <div id="playerInfo">
            <label for="playerNameInput" id="playerNameLabel">Player Name:</label>
            <input type="text" id="playerNameInput" name="username">
        </div>
        <input type="submit" id="searchButton" value="Search Player"/>
        </form>
        <br/>
        <a href="/register.php">
            <button id="searchButton">Register</button>
        </a>
    
        <a href="/leaderboard.php">
            <button id="searchButton">Leaderboard</button>
        </a>
        
        <br/>
        <br/>
        <a href="/login.php">
            <button id="searchButton">Login</button>
        </a>
    </div>
</body>
</html>
