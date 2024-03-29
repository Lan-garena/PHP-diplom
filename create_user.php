<?php 
session_start();
require "functions.php";

$login = $_POST["login"];
$password = $_POST["password"];
$username = $_POST["username"];
$job_title = $_POST["job_title"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$vk = $_POST["vk"];
$telegram = $_POST["telegram"];
$instagram = $_POST["instagram"];
$status = $_POST["status"];

if (!empty($login) and !empty($password)){


if (!empty(get_user_by_login($login))){
	set_flesh_massage("danger","Этот email уже занят");
	relocate("/page_create_user.php");
	exit;
}
$location=upload_file($_FILES['image']['name'], $_FILES['image']['tmp_name']);
add_user($login, $password);
add_user_info($username,$job_title,$phone,$address,$login,$vk,$telegram,$instagram,$status,$location);
relocate("page_create_user.php");
}



