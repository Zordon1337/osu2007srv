<?php
$conn = mysqli_connect("localhost","test","test","osu2007srv");

function InitDB(mysqli $db)
{
    $queryScores = "
    CREATE TABLE IF NOT EXISTS `scores` (
        `fileChecksum` text NOT NULL,
        `Username` text NOT NULL,
        `onlinescoreChecksum` text NOT NULL,
        `count300` text NOT NULL,
        `count100` text NOT NULL,
        `count50` text NOT NULL,
        `countGeki` text NOT NULL,
        `countKatu` text NOT NULL,
        `countMiss` text NOT NULL,
        `totalScore` text NOT NULL,
        `maxCombo` text NOT NULL,
        `perfect` text NOT NULL,
        `ranking` text NOT NULL,
        `enabledMods` text NOT NULL,
        `pass` text NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

$queryUsers = "
    CREATE TABLE IF NOT EXISTS `users` (
        `userid` text NOT NULL,
        `username` text NOT NULL,
        `password` text NOT NULL,
        `totalscore` text NOT NULL,
        `accuracy` text NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";
$queryBeatmapsets = "
CREATE TABLE IF NOT EXISTS `beatmapsets` (
    `checksum` text NOT NULL,
    `name` text NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";
$queryBeatmapsets2 = "
  INSERT IGNORE INTO `beatmapsets` (`checksum`, `name`) VALUES
  ('a5b99395a42bd55bc5eb1d2411cbdf8b', 'Kenji Ninuma - DISCO PRINCE');
  ";
      $db->query($queryScores);
      $db->query($queryUsers);
      $db->query($queryBeatmapsets);
      $db->query($queryBeatmapsets2);
      
}
function CheckIfCorrect($username,$password, mysqli $conn)
{
    InitDB($conn);
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0)
    {
        
        
        return true;
    } else {
        
        
        return false;
    }
}
function InsertScore(Score $score, mysqli $conn)
{
    InitDB($conn);
    $stmt = $conn->prepare("INSERT INTO `scores` (`fileChecksum`, `Username`, `onlinescoreChecksum`, `count300`, `count100`, `count50`, `countGeki`, `countKatu`, `countMiss`, `totalScore`, `maxCombo`, `perfect`, `ranking`, `enabledMods`, `pass`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssssssss", $score->fileChecksum, $score->Username, $score->onlinescoreChecksum, $score->count300, $score->count100, $score->count50, $score->countGeki, $score->countKatu, $score->countMiss, $score->totalScore, $score->maxCombo, $score->perfect, $score->ranking, $score->enabledMods, $score->pass);
    $result = $stmt->execute();
    
    
}
function ReturnScores(mysqli $conn, $checksum)
{
    InitDB($conn);
    $sql = "SELECT * FROM scores WHERE fileChecksum = ? ORDER BY CAST(totalScore AS SIGNED) DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $checksum);
    $result = $stmt->execute();
    $stmt->bind_result($fileChecksum, $Username, $onlinescoreChecksum, $count300, $count100, $count50, $countGeki, $countKatu, $countMiss, $totalScore, $maxCombo, $perfect, $ranking, $enabledMods, $pass);
    $row = 1;
    while ($stmt->fetch()) {
        echo "$row:$Username:$totalScore:$maxCombo:$count50:$count100:$count300:$countMiss:$countKatu:$countGeki:$perfect:$enabledMods\n";
        $row += 1;
    }
}
function ReturnScores2(mysqli $conn, $checksum)
{
    InitDB($conn);
    $sql = "SELECT * FROM scores WHERE fileChecksum = ? ORDER BY CAST(totalScore AS SIGNED) DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $checksum);
    $result = $stmt->execute();
    $stmt->bind_result($fileChecksum, $Username, $onlinescoreChecksum, $count300, $count100, $count50, $countGeki, $countKatu, $countMiss, $totalScore, $maxCombo, $perfect, $ranking, $enabledMods, $pass);
    
    while ($stmt->fetch()) {
        $id = 1;
        if($pass != "False")
        {
            echo "$id|$Username|$totalScore|$maxCombo|$count50|$count100|$count300|$countMiss|$countKatu|$countGeki|$perfect|$enabledMods|$id|$id.png|0\n";
        }
        
    }
    $stmt->close();
}
function ReturnScores5(mysqli $conn, $checksum)
{
    InitDB($conn);
    $sql = "SELECT * FROM scores WHERE fileChecksum = ? ORDER BY CAST(totalScore AS SIGNED) DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $checksum);
    $result = $stmt->execute();
    $stmt->bind_result($fileChecksum, $Username, $onlinescoreChecksum, $count300, $count100, $count50, $countGeki, $countKatu, $countMiss, $totalScore, $maxCombo, $perfect, $ranking, $enabledMods, $pass);
    
    while ($stmt->fetch()) {
        $id = 1;
        if($pass != "False")
        {
            echo "$id|$Username|$totalScore|$maxCombo|$count50|$count100|$count300|$countMiss|$countKatu|$countGeki|$perfect|$enabledMods|$id|$id.png|0\n";
        }
        
    }
    $stmt->close();
}
function GetAccuracy(mysqli $conn, $username)
{
    
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$username);
    $result = $stmt->execute();
    $stmt->bind_result($uid,$username,$password,$totalscore,$accuracy);
    $stmt->fetch();
    return $accuracy;
}
function GetTotalScoreByUser(mysqli $conn, $username)
{
    $sql = "SELECT totalScore FROM scores WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $result = $stmt->execute();
    $stmt->bind_result($totalScore);

    $totalScoreSum = 0;

    while ($stmt->fetch()) {
        $totalScoreSum += (int)$totalScore;
    }
    return $totalScoreSum;
}
function GetPfp(mysqli $conn, $username)
{
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$username);
    $result = $stmt->execute();
    $stmt->bind_result($uid,$username,$password,$totalscore,$accuracy);
    $stmt->fetch();
    return "$uid.png";
}
function GetUserIdByUsername(mysqli $conn, $username)
{
    $sql = "SELECT uid FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($uid);
    $stmt->fetch();
    $stmt->close(); 

    return $uid;
}

function CheckIfBeatmapRanked(mysqli $conn, $checksum)
{
    $sql = "SELECT * FROM beatmapsets WHERE checksum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $checksum);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0)
    {
        return true;
    } else {
        
        
        return false;
    }
}

function GetRank(mysqli $conn, $username)
{
    /*
        todo
    */
    return 1;
}
function CheckIfUserExists(mysqli $conn, $username)
{
    InitDB($conn);
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0)
    {
        return true;
    } else {
        
        
        return false;
    }
}
function CreateAccount(mysqli $conn, $username, $password)
{
    $sql = "INSERT INTO `users`(`userid`, `username`, `password`, `totalscore`, `accuracy`) VALUES (?, ?, ?, '0', '1');";
    $randid = rand(1, 255555);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $randid, $username, $password);
    $result = $stmt->execute();

}
