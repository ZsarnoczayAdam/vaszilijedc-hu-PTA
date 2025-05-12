<?php

session_start();
if (!isset($_SESSION['user'])) {
    include_once 'commons/navbar.php';
    echo "NEM vagy bejelentkezve!";
    die();
}


// Mappa beállítása a képekhez
$upload_dir = "uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Kép feltöltése
if (isset($_POST['upload'])) {
    if (!empty($_FILES['image']['name'])) {
        $file_name = basename($_FILES['image']['name']);
        $target_file = $upload_dir . $file_name;
        
        // Ellenőrizd, hogy valóban kép-e
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                echo "Sikeres feltöltés!";
            } else {
                echo "Hiba történt a feltöltés során.";
            }
        } else {
            echo "Csak JPG, JPEG, PNG és GIF fájlok engedélyezettek.";
        }
    }
}

// Képek listázása
$images = array_diff(scandir($upload_dir), ['.', '..']);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Galéria</title>
</head>
<body>
    <?php include_once 'commons/navbar.php' ?>
    <h2>Képgaléria</h2>
    
    <h3>Képfeltöltés (Csak bejelentkezve)</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <button type="submit" name="upload">Feltöltés</button>
    </form>

    <h3>Képek</h3>
    <?php if ($images): ?>
        <?php foreach ($images as $image): ?>
            <img src="<?= $upload_dir . $image ?>" width="150" style="margin:10px;">
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nincsenek feltöltött képek.</p>
    <?php endif; ?>
</body>
</html>
