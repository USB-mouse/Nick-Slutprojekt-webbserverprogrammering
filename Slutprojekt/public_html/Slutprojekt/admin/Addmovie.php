<?php
require_once('../../../Slutprojekt-app.php');


if (!isset($_SESSION['UserId']) == 1) {
    header("Location: index.php");
    exit;
}

$twig->display('Addmovie.html.twig', context: $view );