<?php

function get_user_by_login($login){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "SELECT * FROM users WHERE login=:login";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":login"=>$login]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	return $user;
}
function get_user_by_id($id){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "SELECT * FROM users WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id"=>$id]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	return $user;
}
function get_user_info_by_id($id){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "SELECT * FROM users_info WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id"=>$id]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	return $user;
}
function set_flesh_massage($name,$massage){
	$_SESSION[$name] = $massage;
}
function relocate($location){
	header("Location:".$location);
	exit;
}
function add_user($login, $password){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$sql = "INSERT INTO users (login,password) VALUES (:login,:password)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":login"=>$login,":password"=>$hashed_password]);
}
function login($login,$password){
	$user = get_user_by_login($login);
if (empty($user)){
	set_flesh_massage("danger","Неверный логин или пароль");
	relocate("page_login.php");
}
if (password_verify($password, $user["password"])){	
	$_SESSION["user"] = $user;
	unset($_SESSION["user"]["password"]);
	relocate("users.php");
}
else {
	set_flesh_massage("danger","Неверный логин или пароль");
	relocate("page_login.php");
}
}
function is_not_login_in(){
	return $_SESSION['user']==Null;
}
function is_admin() {
	return $_SESSION['user']['role']==="admin";
}
function is_that_user($id) {
	return $_SESSION['user']['id']===$id;
}
function get_all_users(){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "SELECT * FROM users_info";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$users = $stmt->fetchall(PDO::FETCH_ASSOC);
	return $users;
}
function upload_file($filename, $tmp_name){
	$result = pathinfo($filename);

	$filename = uniqid() . '.' . $result['extension'];

	$location = 'img/demo/avatars/' . $filename;
	move_uploaded_file($tmp_name, $location);
	return $location;
}
function add_user_info($username,$job_title,$phone,$address,$login,$vk,$telegram,$instagram,$status,$image){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "INSERT INTO `users_info`(`username`, `job_title`, `status`, `image`, `phone`, `address`, `email`, `vk`, `telegram`, `instagram`) VALUES (:username,:job_title,:status,:image,:phone,:address,:email,:vk,:telegram,:instagram)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":username"=>$username,":job_title"=>$job_title,":status"=>$status,":image"=>$image,":phone"=>$phone,":address"=>$address,":email"=>$login,":vk"=>$vk,":telegram"=>$telegram,":instagram"=>$instagram]);
}
function update_user_info($id,$username,$job_title,$phone,$address){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "UPDATE `users_info` SET `id`=:id,`username`=:username,`job_title`=:job_title,`phone`=:phone,`address`=:address WHERE `id`=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id"=>$id,":username"=>$username,":job_title"=>$job_title,":phone"=>$phone,":address"=>$address]);
}
function update_user($id,$login,$password){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$sql = "UPDATE `users` SET `login`=:login,`password`=:password WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id"=>$id,":login"=>$login,":password"=>$hashed_password]);
}
function set_status($id,$status){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "UPDATE `users_info` SET `status`=:status WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id"=>$id,":status"=>$status]);
}
function get_status_by_id($id){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "SELECT status FROM users_info WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id"=>$id]);
	$status = $stmt->fetch(PDO::FETCH_ASSOC);
	return $status;
}
function update_user_image($id,$location){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "UPDATE `users_info` SET `image`=:location WHERE `id`=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id"=>$id,":location"=>$location]);
}
function get_image_by_id($id){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "SELECT image FROM users_info WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id"=>$id]);
	$image = $stmt->fetch(PDO::FETCH_ASSOC);
	return $image;
}
function delete_profile($id){
	$pdo = new PDO("mysql:host=localhost;dbname=diplom;", "root", "");
	$sql = "DELETE FROM `users_info` WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([":id"=>$id]);
}