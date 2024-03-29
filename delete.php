<?php 
session_start();
require "functions.php";

$id = $_GET['id'];


delete_profile($id);
unset($_SESSION);
relocate("page_login.php");