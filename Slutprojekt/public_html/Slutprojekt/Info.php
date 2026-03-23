<?php
require_once('../../Slutprojekt-app.php');
$movieStmt = $pdo->prepare("SELECT * FROM MOVIES WHERE MovieId = :MovieId");
$movieStmt -> execute(["MovieId" => $_GET["MovieId"]]);
$movieResult = $movieStmt->fetchAll();



$view["movies"] = $movieResult;




$twig->display('info.html.twig', context: $view);