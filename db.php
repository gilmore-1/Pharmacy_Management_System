<?php
session_start();
error_reporting(0);
date_default_timezone_set("Asia/Kuala_Lumpur");
$Links = mysqli_connect("localhost", "gqddcaqv_atest", "9U+htYWb;gM&") or die(mysqli_error($Links));
if($Links)
{
    mysqli_select_db($Links, "gqddcaqv_atest");
}
else echo "Unable to connect to databse";
?>