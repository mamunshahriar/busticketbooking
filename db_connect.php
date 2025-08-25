<?php
// Update these with your InfinityFree DB credentials
$db_host = "sql104.infinityfree.com"; // e.g., sql123.epizy.com
$db_user = "if0_39783916";
$db_pass = "gubbusticket";
$db_name = "if0_39783916_GubBusTicket";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) { die("DB connection failed."); }
date_default_timezone_set("Asia/Dhaka");
?>
