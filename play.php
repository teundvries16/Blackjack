<?php
session_start();
if (!isset($_SESSION['user_id'])){
    header("location: login.html");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="game.css">
    <script src="main.js" defer></script>
</head>
<body>
<h2>Dealer:<span id="dealer_number"></span></h2>
<div id="dealer_cards">
    <img id="hidden" src="assets/cards/BACK.png" alt="">
</div>
<h2><?php echo $_SESSION['username'];
 ?>:<span id="player_number"></span></h2>
<div id="player_cards">

</div>
<br>
<button id="hit">Hit</button>
<button id="stand">Stand</button>
<p id="result"></p>
<button id="button" onclick="reload()">Play again!</button>

<div class="scores">
    <ul>
        Wins:<li id="wins"><?php echo $_SESSION['wins']?></li>
        Losses:<li id="losses"><?php echo $_SESSION['losses']?></li>
        Pushes:<li id="pushes"><?php echo $_SESSION['pushes']?></li>
    </ul>
</div>

</body>
</html>