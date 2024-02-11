<?php
if(!isset($_GET['username']))
{
    http_response_code(403);
    die();
}
$username = $_GET['username'];
include("utils/db.php");
echo "<!DOCTYPE html>
<html lang=''en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
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
    <div id='container'>
    <h1>$username</h1>";
if(CheckIfUserExists($conn,$username))
{
    $accuracy = floatval(GetAccuracy($conn,$username))*100;
    $score = GetTotalScoreByUser($conn,$username);
    $rank = GetRank($conn,$username);
echo " 
<pre>
Accuracy: $accuracy%<br/>
Total Score: $score<br/>
Rank: #$rank
</pre>
</form>
</div>
</body>
</html>";
} else {
    echo "
   User doesn't exist     
    </form>
    </div>
    </body>
    </html>
";
}


