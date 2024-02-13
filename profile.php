<?php
ini_set('display_errors', 0);
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
        @import url('main.css');
    </style>
</head>
<body>
    <div id='container'>
    <h1>$username</h1>";
if(CheckIfUserExists($conn,$username))
{
    $accuracy = round(floatval(GetAccuracy($conn,$username))*100,2);
    $score = number_format(GetTotalScoreByUser($conn,$username));
    $rank = number_format(GetRank($conn,$username));
    $img = GetPfp($conn,$username);
    $add = "";
    if(CheckIfAdmin($conn,$username))
    {
        $add = "<p id='adminBadge'>ADMIN</p>";
    }
    if(CheckIfBanned($username))
    {
        $days = CalculateBanDays(GetBanExpiration($conn,$username));
        $baninfo2 = "";
        if(CheckIfAdmin($conn,$username))
        {
            $baninfo2 = "";
        }
        $baninfo = "<p id='adminBadge'>User is restricted<br/>days since restrict: $days<br/>
        $baninfo2
        </p>";
    }
echo " 
<img id='pfp' src='/forum/download.php?avatar=$img' height='186' width='186'/>
$add
$baninfo
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


