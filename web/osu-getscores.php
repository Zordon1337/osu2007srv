<?php
include("../utils/db.php");
$checksum = $_GET["c"];
ReturnScores($conn,$checksum);
