<?php
require_once "conn.php";

$sql = $conn->prepare("SELECT * FROM scores WHERE user_id = :user_id");
$sql->execute([
    ":user_id" => $_SESSION['user_id']
]);
$fetch = $sql->fetch();
$_SESSION['losses'] = $fetch["losses"];