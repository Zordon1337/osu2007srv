<?php
include("utils/db.php");
ini_set('display_errors', 0);
session_start();
if(!isset($_GET["c"]))
{
    http_response_code(401);
    die();
} else {
    if(session_status() == PHP_SESSION_ACTIVE)
    {
        if(!isset($_SESSION['username'])||!isset($_SESSION['password']))
        {
            http_response_code(403);
            die();
        } else {
            if(!CheckIfCorrect($_SESSION['username'],$_SESSION['password'],$conn))
            {
                http_response_code(403);
                die();
            }
        }
    } else {
        http_response_code(403);
        die();
    }
    if(CheckIfAdmin($conn,$_SESSION['username']))
    {
        $c = $_GET['c'];
        $data = "Added using built-in submit";
        $stmt = $conn->prepare("INSERT INTO `beatmapsets`(`checksum`, `name`) VALUES (?, ?)");
        
        $stmt->bind_param("ss",$c,$data);
        $stmt->execute();
        Header("location: /index.php");
        die();
    } else {
        Header("location: /index.php");
        die();
    }
    
}

?>