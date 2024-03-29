<?php
session_start();
require "functions.php";

$login = $_POST["login"];
$password = $_POST["password"];

get_user_by_login($login);

if (!empty($user)){
	set_flesh_massage("danger","Этот email уже занят");
	relocate("/page_register.php");
	exit;
}
add_user($login, $password);
	set_flesh_massage("success","Запись успешно добавленна.");
	relocate("/page_login.php");