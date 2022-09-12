<?php

$con=mysqli_connect("localhost","root","","attendance");

date_default_timezone_set('Asia/Kolkata');

session_start();


if(mysqli_connect_errno()){
    echo "Failed to connect to MySql:";
}
?>