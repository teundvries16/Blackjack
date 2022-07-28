<?php
require_once "conn.php";

$username = $_POST['username'];
$password = $_POST['password'];
$wins = 0;
$loses = 0;
$pushes = 0;

echo $username, $password;

    try {
        $insert_user = $conn->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
        $insert_user->execute([
            ":username" => $username,
            ":password" => $password
        ]);
        $user_id = $conn->lastInsertId();
        $sql = $conn->prepare("INSERT INTO scores (user_id, wins, losses, pushes) VALUES (:user_id, :wins, :loses, :pushes)");
        $sql->bindParam(":user_id", $user_id);
        $sql->bindParam(":wins", $wins);
        $sql->bindParam(":loses", $loses);
        $sql->bindParam(":pushes", $pushes);
        $sql->execute();

    } catch (PDOException $error) {
        echo $error->getMessage();}


header("location: login.html");

