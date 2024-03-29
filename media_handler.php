<?php 
session_start(); 
require "functions.php";

$id = $_GET['id'];
$location = upload_file($_FILES['image']['name'], $_FILES['image']['tmp_name']);

update_user_image($id,$location);
set_flesh_massage("success","Картинка успешно добавленна");
relocate("media.php?id=".$_GET["id"]);