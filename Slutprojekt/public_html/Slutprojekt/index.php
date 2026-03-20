<?php
require_once('../../Slutprojekt-app.php');
$userStmt = $pdo->prepare("SELECT * FROM USERS");
$userStmt -> execute();
$userResult = $userStmt->fetchAll();

$view["users"] = $userResult;
$view["namn"] = "Admin";
$view["exempelLista"] = ["Sak 1", "Sak 2", "Sak 3"];


$twig->display('Main.html.twig', context: $view);