<?php
include("../utils/config.php");
include("../utils/score.php");
include("../utils/db.php");
/*
experimental submit endpoint for b504
*/
if($b504_experiment == true)
{
    if(!isset($_GET['score'])||!isset($_GET['pass']))
    {
        http_response_code(401);
        die();
    }
    
    $score = $_GET['score']; // score separated by :
    $password = $_GET['pass']; //md5 hash of password
    $arr = explode(":", $score);
    // see score.php
    $s = new Score($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7],$arr[8],$arr[9],$arr[10],$arr[11],$arr[12],$arr[13],$arr[14]);
    if($save_replays == true)
    {
        $replayname = $s->onlinescoreChecksum . ".osr";
        $replay = move_uploaded_file($_FILES['score']["tmp_name"],"../replays/$replayname"); // replay file
    }
    if(CheckIfCorrect($s->Username,$password,$conn))
    {
        InsertScore($s,$conn);
    }
    
    
}