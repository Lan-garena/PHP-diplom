<?php 
session_start();
require 'functions.php';

$login = $_POST["login"];
$password = $_POST["password"];

login($login,$password);