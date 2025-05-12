<?php
session_start();
$host = "localhost"; // Adatbázis szerver
$dbname = "kapcsolat_db"; // Adatbázis neve
$username = "root"; // XAMPP esetén root
$password = ""; // hagyd üresen

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Hiba az adatbázis kapcsolat során: " . $e->getMessage());
}

// Űrlap ellenőrzés és mentés
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // Szerveroldali ellenőrzés
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Hibás adatok! Kérlek töltsd ki megfelelően az űrlapot.";
    } else {
        // Adatok mentése adatbázisba
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $message])) {
            $_SESSION["last_submission"] = [
                "name" => $name,
                "email" => $email,
                "message" => $message
            ];
            header("Location: ?success=true"); // Az adatok megjelenítése az 5. oldalon
            exit();
        } else {
            $error = "Hiba történt az adat mentése során.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kapcsolat</title>
    <script>
        function validateForm() {
            let name = document.forms["contactForm"]["name"].value;
            let email = document.forms["contactForm"]["email"].value;
            let message = document.forms["contactForm"]["message"].value;
            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (name === "" || email === "" || message === "" || !emailPattern.test(email)) {
                alert("Kérlek töltsd ki megfelelően az űrlapot!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include_once 'commons/navbar.php'; ?>
    <h2>Kapcsolatfelvételi űrlap</h2>
    <form name="contactForm" method="post" onsubmit="return validateForm()">
        Név: <input type="text" name="name" required><br>
        E-mail: <input type="text" name="email" required><br>
        Üzenet: <textarea name="message" required></textarea><br>
        <button type="submit">Küldés</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <?php if (isset($_GET["success"]) && isset($_SESSION["last_submission"])): ?>
        <h2>Ötödik oldal: Beküldött adatok</h2>
        <p><strong>Név:</strong> <?= $_SESSION["last_submission"]["name"] ?></p>
        <p><strong>E-mail:</strong> <?= $_SESSION["last_submission"]["email"] ?></p>
        <p><strong>Üzenet:</strong> <?= $_SESSION["last_submission"]["message"] ?></p>
        <?php unset($_SESSION["last_submission"]); ?>
    <?php endif; ?>
</body>
</html>
