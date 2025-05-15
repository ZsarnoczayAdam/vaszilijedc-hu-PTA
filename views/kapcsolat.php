<?php
session_start();
$host = $mysql_credentials["host"];
$dbname = $mysql_credentials["db_name"]; /
$username = $mysql_credentials["username"]; 
$password = $mysql_credentials["password"]; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Hiba az adatbázis kapcsolat során: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Hibás adatok! Kérlek töltsd ki megfelelően az űrlapot.";
    } else {
        
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $message])) {
            $_SESSION["last_submission"] = [
                "name" => $name,
                "email" => $email,
                "message" => $message
            ];
            header("Location: ?page=kapcsolat&success=true"); 
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
    <?php
    include_once "commons/header.php";?>
    
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
    <div class="container mt-5">
  <h2 class="mb-4">Kapcsolatfelvételi űrlap</h2>
  <form name="contactForm" method="post" action="/index.php?page=kapcsolat">
    <div class="mb-3 row">
      <label for="name" class="col-sm-2 col-form-label">Név</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
    </div>
    <div class="mb-3 row">
      <label for="email" class="col-sm-2 col-form-label">E-mail</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="email" required>
      </div>
    </div>
    <div class="mb-3 row">
      <label for="message" class="col-sm-2 col-form-label">Üzenet</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
      </div>
    </div>
    <div class="row">
      <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Küldés</button>
      </div>
    </div>
  </form>
</div>


    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <?php if (isset($_GET["success"]) && isset($_SESSION["last_submission"])): ?>
        <h2>Beküldött adatok</h2>
        <p><strong>Név:</strong> <?= $_SESSION["last_submission"]["name"] ?></p>
        <p><strong>E-mail:</strong> <?= $_SESSION["last_submission"]["email"] ?></p>
        <p><strong>Üzenet:</strong> <?= $_SESSION["last_submission"]["message"] ?></p>
        <?php unset($_SESSION["last_submission"]); ?>
    <?php endif; ?>
</body>
</html>
