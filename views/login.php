<?php
session_start();

// Adatbázis kapcsolat (változtasd meg saját adatbázisod adataival)
$dsn = "mysql:host=localhost;dbname=adatbazis;charset=utf8mb4";
$username = "root";
$password = "";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Hiba az adatbázis kapcsolat során: " . $e->getMessage());
}

// Regisztráció
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        echo "Sikeres regisztráció! Most bejelentkezhetsz.";
    } else {
        echo "Hiba történt a regisztráció során.";
    }
}

// Bejelentkezés
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        echo "Sikeres bejelentkezés! Üdv, " . $_SESSION['user'];
    } else {
        echo "Hibás felhasználónév vagy jelszó.";
    }
}

// Kijelentkezés
if (isset($_GET['logout'])) {
    $_SESSION['user'] = $user[''];
    session_start();
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/'); // A session cookie törlése
header("Location: index.php");
exit();
}
?>

<!DOCTYPE html>

<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés / Regisztráció</title>
</head>
<body>
    <?php include_once "commons/navbar.php" ?>
    <h2>Regisztráció</h2>
    <form method="post">
        Felhasználónév: <input type="text" name="username" required>
        Jelszó: <input type="password" name="password" required>
        <button type="submit" name="register">Regisztráció</button>
    </form>

    <h2>Bejelentkezés</h2>
    <form method="post">
        Felhasználónév: <input type="text" name="username" required>
        Jelszó: <input type="password" name="password" required>
        <button type="submit" name="login">Bejelentkezés</button>
    </form>

    <h2>Kijelentkezés</h2>
    <a href="?logout=true">Kijelentkezés</a>
</body>
</html>
