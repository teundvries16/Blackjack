<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=login",
        "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connectie gelukt! <br>";
}
catch (PDOException $e)
{
    echo "Connectie mislukt: " . $e->getMessage();
}
