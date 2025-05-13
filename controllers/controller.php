<?php
    if (!isset($_GET['page']) || $_GET['page'] == "main") {
        include_once "main/main_controller.php";

    } else if ($_GET['page'] == "blog") {
        include_once "blog/blog_controller.php";
    } else if ($_GET["page"] == "kapcsolat") {
        include_once "kapcsolat/kapcsolat_controller.php";
    }
    else if ($_GET["page"] == "galeria") {
        include_once "galeria/galeria_controller.php";
        
    } else if ($_GET["page"] == "login") {
        include_once "views/login.php";

    }
else if ($_GET["page"] == "messages") {
    include_once "messages/messages.php";

}
?>