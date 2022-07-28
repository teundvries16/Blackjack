<?php
session_start();
require_once "conn.php";

$username = $_POST['username'];
$password = $_POST['password'];


echo $username,$password;
$sql = $conn->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
$sql->execute([
    ":username" => $username,
    ":password" => $password
]);
$fetch = $sql->fetch();

$_SESSION['user_id'] = $fetch["id"];
$_SESSION['username'] = $fetch["username"];
header("location: play.php");


