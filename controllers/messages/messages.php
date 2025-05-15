<?php
$host = $mysql_credentials["host"];
$dbname = $mysql_credentials["db_name"]; 
$username = $mysql_credentials["username"]; 
$password = $mysql_credentials["password"]; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Hiba az adatbázis kapcsolat során: " . $e->getMessage());
}
$stmt = $pdo->prepare("SELECT * FROM messages ORDER BY datum DESC");
    $stmt->execute();

    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include_once "views/messages.php";