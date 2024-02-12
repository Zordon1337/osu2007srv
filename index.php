<?php ini_set('display_errors', 0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>osu2007srv</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #container {
            border: 2px solid #000000;
            padding: 20px;
            text-align: center;
        }

        #playerNameLabel {
            display: block;
            margin-bottom: 10px;
        }

        #playerNameInput {
            width: 200px;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        #searchButton {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        #searchButton:hover {
            background-color: #45a049;
        }
        #playerInfo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
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
        
        <a href="/newmap.php">
            <button id="searchButton">Rank map</button>
        </a>
        <br/>
        <br/>
        <a href="/leaderboard.php">
            <button id="searchButton">Leaderboard</button>
        </a>
        
        <a href="/login.php">
            <button id="searchButton">Login</button>
        </a>
    </div>
</body>
</html>
