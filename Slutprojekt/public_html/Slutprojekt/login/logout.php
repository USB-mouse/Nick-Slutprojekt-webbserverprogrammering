<?php
require_once('../../../Slutprojekt-app.php');

$_SESSION = [];
session_destroy();
unset($view["username"]);



$twig->display('logout.html.twig', context: $view );