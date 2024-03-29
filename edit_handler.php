<?php  
session_start();
require "functions.php";
$id = $_GET["id"];
$username = $_POST["username"];
$job_title = $_POST["job_title"];
$phone = $_POST["phone"];
$address = $_POST["address"];

update_user_info($id,$username,$job_title,$phone,$address);
relocate("users.php");


