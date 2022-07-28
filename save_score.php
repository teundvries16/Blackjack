<?php
session_start();
require_once "conn.php";
require_once "fetch_wins.php";
require_once "fetch_losses.php";
require_once "fetch_pushes.php";

$status = "";

$user_id = $_SESSION['user_id'];

// EERST ALLE WINS, LOSSES EN PUSHES UIT DE DATABASE HALEN!


$wins = $_SESSION['wins'];
$losses = $_SESSION['losses'];
$pushes = $_SESSION['pushes'];

//Stap 1 : player ophalen uit de database

// met SQL SELECT WHERE username = username en password = password


//Stap 2: Zoek uit hoe je weet of iemand gewonnen heeft (of verloren, of gelijk).

//Hint: met een switch


switch ($status){
    case "win":
        $wins++;
        $sql = $conn->prepare("UPDATE scores SET wins = :wins WHERE user_id = :user_id");
        $sql->execute([
            ":wins" => $wins,
            ":user_id" => $user_id
        ]);
        break;

    case "loss":
        $losses++;
        $sql = $conn->prepare("UPDATE scores SET losses = :losses WHERE user_id = :user_id");
        $sql->execute([
            ":losses" => $losses,
            ":user_id" => $user_id
        ]);
        break;

    case "push":
        $pushes++;
        $sql = $conn->prepare("UPDATE scores SET pushes = :pushes WHERE user_id = :user_id");
        $sql->execute([
            ":pushes" => $pushes,
            ":user_id" => $user_id
        ]);
        break;
}

        /*Als er is gewonnen increase dan de user data uit de database met 1*/
        /*Als er is verloren  verlaag dan de user data uit de database met 1 */



        //Vervolgens als winnaar, verlies, of gelijkspel is increased
        //stop de user weer in data database (Update query)