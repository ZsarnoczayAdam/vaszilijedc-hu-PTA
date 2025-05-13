<?php
$host = $mysql_credentials["host"];// Adatbázis szerver
$dbname = $mysql_credentials["db_name"]; // Adatbázis neve
$username = $mysql_credentials["username"]; // XAMPP esetén root
$password = $mysql_credentials["password"]; // hagyd üresen

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Hiba az adatbázis kapcsolat során: " . $e->getMessage());
}
$stmt = $pdo->prepare("SELECT * FROM messages ORDER BY datum DESC");
    $stmt->execute();

    // 3. Fetch all rows
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include_once "views/messages.php";