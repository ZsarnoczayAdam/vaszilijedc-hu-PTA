<?php
    if (!isset($_GET['page']) || $_GET['page'] == "main") {
        include_once "main/main_controller.php";

    } else if ($_GET['page'] == "blog") {
        include_once "blog/blog_controller.php";
    }
?>