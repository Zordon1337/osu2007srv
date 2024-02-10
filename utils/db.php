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
      $db->query($queryScores);
      $db->query($queryUsers);
      
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
        $stmt->close();
        $conn->close();
        return true;
    } else {
        $stmt->close();
        $conn->close();
        return false;
    }
}
function InsertScore(Score $score, mysqli $conn)
{
    $conn = mysqli_connect("localhost","test","test","testdb");
    InitDB($conn);
    $stmt = $conn->prepare("INSERT INTO `scores` (`fileChecksum`, `Username`, `onlinescoreChecksum`, `count300`, `count100`, `count50`, `countGeki`, `countKatu`, `countMiss`, `totalScore`, `maxCombo`, `perfect`, `ranking`, `enabledMods`, `pass`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssssssss", $score->fileChecksum, $score->Username, $score->onlinescoreChecksum, $score->count300, $score->count100, $score->count50, $score->countGeki, $score->countKatu, $score->countMiss, $score->totalScore, $score->maxCombo, $score->perfect, $score->ranking, $score->enabledMods, $score->pass);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
}
