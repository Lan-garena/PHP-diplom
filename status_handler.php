<?php 
session_start();
require "functions.php";

$status = $_POST['status'];
$id = $_GET["id"];

set_status($id,$status);
relocate("status.php?id=".$_GET['id']);
exit;