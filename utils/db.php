<?php ini_set('display_errors', 0); ?>
<?php
include("conn.php");

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
    `accuracy` text NOT NULL,
    `S` text NOT NULL,
    `SS` text NOT NULL,
    `A` text NOT NULL
    `join_date` text NOT NULL,
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";
$queryAdmins = "
CREATE TABLE IF NOT EXISTS `admins` (
    `username` text NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";
$queryBeatmapsets = "
CREATE TABLE IF NOT EXISTS `beatmapsets` (
    `checksum` text NOT NULL,
    `name` text NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";
$restrictedPlayers = "
CREATE TABLE IF NOT EXISTS `bans` (
    `username` text NOT NULL,
    'reason' text NOT NULL,
    `bandate` text NOT NULL,
    `banexpire` text NOT NULL,
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4";
$queryBeatmapsets2 = "
  INSERT IGNORE INTO `beatmapsets` (`checksum`, `name`) VALUES
  ('a5b99395a42bd55bc5eb1d2411cbdf8b', 'Kenji Ninuma - DISCO PRINCE');
  ";
      if(!CheckIfBeatmapRanked($db,"a5b99395a42bd55bc5eb1d2411cbdf8b"))
      {
        $db->query($queryBeatmapsets);
        $db->query($queryBeatmapsets2);

      }
      $db->query($queryAdmins);
      $db->query($queryUsers);
      $db->query($queryScores);
      $db->query($restrictedPlayers);
      
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
function BanUser(mysqli $conn,string $username, string $till,string $reason)
{
    $bandate = date("Y-m-d");
    $stmt = $conn->prepare("INSERT INTO `bans`(`username`, `reason`, `bandate`, `banexpire`) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$username,$reason,$bandate,$till);
    $stmt->execute();
}
function InsertScore(Score $score, mysqli $conn)
{
    InitDB($conn);
    $stmt = $conn->prepare("INSERT INTO `scores` (`fileChecksum`, `Username`, `onlinescoreChecksum`, `count300`, `count100`, `count50`, `countGeki`, `countKatu`, `countMiss`, `totalScore`, `maxCombo`, `perfect`, `ranking`, `enabledMods`, `pass`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssssssss", $score->fileChecksum, $score->Username, $score->onlinescoreChecksum, $score->count300, $score->count100, $score->count50, $score->countGeki, $score->countKatu, $score->countMiss, $score->totalScore, $score->maxCombo, $score->perfect, $score->ranking, $score->enabledMods, $score->pass);
    $result = $stmt->execute();
    $totalscore = GetTotalScoreByUser($conn,$score->Username);
    $A = strval(CalculateAGrades($conn, $score->Username));
    $S = strval(CalculateSGrades($conn, $score->Username));
    $SS = strval(CalculateSSGrades($conn, $score->Username));
    $accuracy = GetAccuracy($conn, $score->Username);
    

    $stmt = $conn->prepare("UPDATE `users` SET `totalscore`=?, `accuracy`=?, `S`=?, `SS`=?, `A`=? WHERE username = ?");
    $stmt->bind_param("ssssss", $totalscore, $accuracy, $S, $SS, $A, $score->Username);
    $result = $stmt->execute();
    
   
   
}

function CalculateAGrades(mysqli $conn, $username)
{
    $ranking = 'A';
    $sql = "SELECT * FROM scores WHERE Username = ? AND ranking = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username,$ranking);
    $result = $stmt->execute();
    
    $result = $stmt->get_result();
    return $result->num_rows;
}

function CalculateSGrades(mysqli $conn, $username)
{
    $ranking = 'S';
    $sql = "SELECT * FROM scores WHERE Username = ? AND ranking = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $ranking); 
    $result = $stmt->execute();
    
    $result = $stmt->get_result();
    return $result->num_rows;
}

function CalculateSSGrades(mysqli $conn, $username)
{
    $ranking = 'X';
    $sql = "SELECT * FROM scores WHERE Username = ? AND ranking = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username,$ranking);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows;
}

function ReturnScores(mysqli $conn, $checksum)
{
    InitDB($conn);
    $sql = "WITH RankedScores AS (
        SELECT *,
            ROW_NUMBER() OVER (PARTITION BY Username ORDER BY CAST(totalScore AS SIGNED) DESC) AS row_num
        FROM scores
        WHERE fileChecksum = ?
    )
    SELECT fileChecksum, Username, onlinescoreChecksum, count300, count100, count50, countGeki, countKatu, countMiss, totalScore, maxCombo, perfect, ranking, enabledMods, pass
    FROM RankedScores
    WHERE row_num = 1
    ORDER BY CAST(totalScore AS SIGNED) DESC";
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

    $sql = "WITH RankedScores AS (
                SELECT *,
                    ROW_NUMBER() OVER (PARTITION BY Username ORDER BY CAST(totalScore AS SIGNED) DESC) AS row_num
                FROM scores
                WHERE fileChecksum = ?
            )
            SELECT fileChecksum, Username, onlinescoreChecksum, count300, count100, count50, countGeki, countKatu, countMiss, totalScore, maxCombo, perfect, ranking, enabledMods, pass
            FROM RankedScores
            WHERE row_num = 1
            ORDER BY CAST(totalScore AS SIGNED) DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $checksum);
    $result = $stmt->execute();
    $stmt->bind_result($fileChecksum, $Username, $onlinescoreChecksum, $count300, $count100, $count50, $countGeki, $countKatu, $countMiss, $totalScore, $maxCombo, $perfect, $ranking, $enabledMods, $pass);

    $id = 1;
    while ($stmt->fetch()) {
        if ($pass != "False") {
            echo "$id|$Username|$totalScore|$maxCombo|$count50|$count100|$count300|$countMiss|$countKatu|$countGeki|$perfect|$enabledMods|$id|$id.png|0\n";
        }
        $id++;
    }

    $stmt->close();
}


function CheckIfAdmin(mysqli $conn, $username)
{
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows != 0)
    {
        return true;
    } else {
        return false;
    }

}
function ReturnScores5(mysqli $conn, $checksum)
{
    InitDB($conn);
    $sql = "WITH RankedScores AS (
        SELECT *,
            ROW_NUMBER() OVER (PARTITION BY Username ORDER BY CAST(totalScore AS SIGNED) DESC) AS row_num
        FROM scores
        WHERE fileChecksum = ?
    )
    SELECT fileChecksum, Username, onlinescoreChecksum, count300, count100, count50, countGeki, countKatu, countMiss, totalScore, maxCombo, perfect, ranking, enabledMods, pass
    FROM RankedScores
    WHERE row_num = 1
    ORDER BY CAST(totalScore AS SIGNED) DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $checksum);
    $result = $stmt->execute();
    $stmt->bind_result($fileChecksum, $Username, $onlinescoreChecksum, $count300, $count100, $count50, $countGeki, $countKatu, $countMiss, $totalScore, $maxCombo, $perfect, $ranking, $enabledMods, $pass);
    
    while ($stmt->fetch()) {
        $id = 1;
        if($pass != "False")
        {
            echo "$id|$Username|$totalScore|$maxCombo|$count50|$count100|$count300|$countMiss|$countKatu|$countGeki|0|$enabledMods|$id|$id|0\n";
        }
        
    }
    $stmt->close();
}
function GetAccuracy(mysqli $conn, $username)
{
    $sql = "SELECT * FROM scores WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $result = $stmt->execute();
    $stmt->bind_result($fileChecksum, $Username, $onlinescoreChecksum, $count300, $count100, $count50, $countGeki, $countKatu, $countMiss, $totalScore, $maxCombo, $perfect, $ranking, $enabledMods, $pass);

    $accuracy = 0;
    $row = 0;

    while ($stmt->fetch()) {
        if($pass != "False")
        {
            $accuracy += (float)((int)$count50 * 50 + (int)$count100 * 100 + (int)$count300 * 300) / (float)(((int)$count300 + (int)$count100 + (int)$count50 + (int)$countGeki + (int)$countKatu + (int)$countMiss) * 300);
            $row++;
        }
    }
    if ($row > 0) {
        return round($accuracy / $row,2);
    } else {
        return 1; 
    }
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
    $sql = "SELECT userid FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$username);
    $result = $stmt->execute();
    $stmt->bind_result($uid);
    $stmt->fetch();
    return "$uid.jpg";
}
function GetUserIdByUsername(mysqli $conn, $username)
{
    $sql = "SELECT userid FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($uid);
    $stmt->fetch();
    $stmt->close(); 

    return $uid;
}
function GetPlayersAmount(mysqli $conn)
{
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows;
}
function GetTotalPlayCount(mysqli $conn)
{
    $stmt = $conn->prepare("SELECT * FROM scores");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows;
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
    InitDB($conn);

    $sql = "SELECT Username, totalscore
            FROM users
            ORDER BY CAST(totalscore AS SIGNED) DESC";

    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    $stmt->bind_result($currentUsername, $totalscore);

    $id = 1;
    while ($stmt->fetch()) {
        if (strcasecmp($currentUsername, $username) === 0) {
            return $id;
        }
        $id++;
    }
    return 0; 
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
    $sql = "INSERT INTO `users`(`userid`, `username`, `password`, `totalscore`, `accuracy`, `S`, `SS`, `A`) VALUES (?, ?, ?, '0', '1', '0', '0', '0');";
    $randid = rand(1, 255555);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $randid, $username, $password);
    $result = $stmt->execute();
}





function RenderLeaderboard(mysqli $conn)
{
    $sql = "SELECT *
            FROM users
            ORDER BY CAST(totalscore AS SIGNED) DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->bind_result($userid,$username,$password,$totalscore,$accuracy,$S,$SS,$A);
    
    $top = 1;
    while ($stmt->fetch()) {
        $accuracy2 = round((float)$accuracy*100,2);
        $totalscore2 = number_format((int)$totalscore);
        echo "
        <tr>
        <td>$top</td>
        <td>$username</td>
        <td>$totalscore2</td>
        <td>$accuracy2%</td>
        <td>$SS</td>
        <td>$S</td>
        <td>$A</td>
        </tr>";
        $top++;
    }
    echo "</tbody>
    </table>
    </div>
    </body>";
}

function OnlineRecord(mysqli $conn, $username)
{
    $sql = "SELECT *
            FROM scores
            ORDER BY CAST(totalscore AS SIGNED) DESC
            WHERE Username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0)
    {
        $stmt->bind_result($fileChecksum, $Username, $onlinescoreChecksum, $count300, $count100, $count50, $countGeki, $countKatu, $countMiss, $totalScore, $maxCombo, $perfect, $ranking, $enabledMods, $pass);
    
        while ($stmt->fetch()) {
            $id = 1;
            if($pass != "False" && $id <= 1)
            {
                echo "$id|$Username|$totalScore|$maxCombo|$count50|$count100|$count300|$countMiss|$countKatu|$countGeki|0|$enabledMods|$id|$id|0\n";
                $id++;
            }
            
        }
        
    } else {
        echo "\n";
    }
}
