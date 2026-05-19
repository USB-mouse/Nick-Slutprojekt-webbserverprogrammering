<?php
require_once('../../../Slutprojekt-app.php');

// Kanske vill du bara att inloggade ska kunna lägga till filmer?
if (!isset($_SESSION['UserId']) == 1) {
    header("Location: index.php");
    exit;
}

$twig->display('Addmovie.html.twig', context: $view );