<?php ini_set('display_errors', 0); ?>
<?php
$hostname = "127.0.0.1";
$user = "test";
$password = "test";
$database = "osu2007srv";
$port = 3306;
$conn = mysqli_connect($hostname,$user,$password,$database,$port);