
<!DOCTYPE html>
<html lang="hu">
<head>
    
    <title>Üzenetek</title>
    
    <?php
    include_once "commons/header.php";?>
</head>
<body class="bg-light">
<?php
        include_once "commons/navbar.php";
    ?>
<div class="container mt-5">
    <h2 class="mb-4">Beérkezett üzenetek</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm bg-white">
            <thead class="table-primary">
                <tr>
                    <th>Feladó</th>
                    <th>Dátum</th>
                    <th>Üzenet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                

                foreach ($rows as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['datum']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>