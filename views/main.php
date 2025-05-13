<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "commons/header.php";?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bg-light p-4">
    <?php include_once "commons/navbar.php"; ?>
    
    <div class="container">
        
        
        
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="ratio ratio-16x9">
                    <video controls>
                        <source src="/Venice_5.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/ybyZDrPPRhI?si=uqGtSE22S1lZifjP"
                            title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-12">
                <div class="ratio ratio-4x3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2697.4116459957745!2d19.112390976259064!3d47.462407197923774!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c2d352460591%3A0xfbd0c883c2b59538!2sBudapest%2C%20LobogÃ³%20u.%2C%201098!5e0!3m2!1shu!2shu!4v1747120418910!5m2!1shu!2shu"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>