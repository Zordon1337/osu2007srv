<?php
/*
shitty and basic, only does basic checks that can be easily bypassed if you know how
*/
include("conn.php");
function CheckMods(string $mods)
{
    $m = (int)$mods;
}
function CalculateBanDays(string $date)
{
    $timestamp = strtotime($date);
    return floor(($timestamp - time())/(60*60*24));
}
function BanUser(mysqli $conn,string $username, string $till,string $reason)
{
    $bandate = date("Y-m-d");
    $stmt = $conn->prepare("INSERT INTO `bans`(`username`, `reason`, `bandate`, `banexpire`) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$username,$reason,$bandate,$till);
    $stmt->execute();
    $stmt->close();
}
function CheckIfBanned(string $username)
{
    include("conn.php");
    $conn2 = mysqli_connect($hostname,$user,$password,$database,$port);
    $stmt = $conn2->prepare("SELECT * FROM bans WHERE username = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0)
    {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}
function GetBanExpiration(mysqli $conn,string $username)
{
    $stmt = $conn->prepare("SELECT * FROM bans WHERE username = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt->bind_result($username,$reason,$bandate,$banexpire);
    while($stmt->fetch())
    {
        return $banexpire;
    }
}