<?php

/*
yet another forum endpoint,
this one is used for pfp downloading
introduced around b144
*/

$avatar = $_GET['avatar']; // basically avatar name
header("Content-type: image/png");
$filePath = "./avatars/$avatar";
if(file_exists($filePath))
{
    readfile($filePath);
} else {
    readfile("./avatars/default.png");
}
?>
