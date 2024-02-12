<?php ini_set('display_errors', 0); ?>
<?php

/*
yet another forum endpoint,
this one is used for pfp downloading
introduced around b144
*/

$avatar = $_GET['avatar']; // basically avatar name
header("Content-type: image/jpg");
$filePath = "./avatars/$avatar";
if(file_exists($filePath))
{
    readfile($filePath);
} else {
    readfile("./avatars/default.png");
}
?>
