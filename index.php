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
<?php
include_once('utils/config.php');
include_once('utils/db.php');
include_once('utils/web.php');
DrawNavbar($server_name);

?>
        
    <div id="container">
        <form action="/profile.php" method="GET"/>
        <img src="img/placeholder.gif" height="160"width="160"/>
<?php
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
        
    
        
        
        <br/>
        <br/>
        
    </div>
</body>
</html>
