<?php
include("utils/db.php");
ini_set('display_errors', 0);
if(!isset($_GET["c"]))
{
    http_response_code(401);
    die();
} else {
    $c = $_GET['c'];
    $data = "Added using built-in submit";
    $stmt = $conn->prepare("INSERT INTO `beatmapsets`(`checksum`, `name`) VALUES (?, ?)");
    
    $stmt->bind_param("ss",$c,$data);
    $stmt->execute();
    Header("location: /index.php");
    die();
}

?>