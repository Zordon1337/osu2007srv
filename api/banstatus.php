<?php
include("../utils/db.php");
$username = $_GET['u'];
if(CheckIfBanned($username))
{
    $days = GetBanExpiration($conn,$username);
    echo "1|$days";
} else {
    echo "0";
}
?>