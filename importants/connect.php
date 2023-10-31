<?php

function connectToDatabase() {
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "cafe_inventory";

    try {
        $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } 
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

?>
