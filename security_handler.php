<?php
session_start();
require "functions.php";

$login = $_POST["login"];
$password = $_POST["password"];
$id = $_GET["id"];

if (!empty($login) and !empty($password)) {
$user = get_user_by_login($login);
if (!empty($user)) {
	set_flesh_massage("danger","Этот email уже занят");
	relocate("security.php?id=".$_GET["id"]);
	exit;
}
else {
	update_user($id,$login,$password);
	$_SESSION['user']['login'] = $login;
	set_flesh_massage("success","Данные успешно изменены");
	relocate("security.php?id=".$_GET["id"]);
	exit;
}
}
else {
	set_flesh_massage("danger","Недопустимое значение логина или пароля");
	relocate("security.php?id=".$_GET["id"]);
	exit;
}