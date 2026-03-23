<?php
require_once('../../Slutprojekt-app.php');
$movieStmt = $pdo->prepare("SELECT * FROM MOVIES");
$movieStmt -> execute();
$movieResult = $movieStmt->fetchAll();




$view["movies"] = $movieResult;




$twig->display('Main.html.twig', context: $view);