<?php
require_once('../../Slutprojekt-app.php');


$ReviewStmt = $pdo->prepare("SELECT * FROM Reviews WHERE MovieId = :MovieId ORDER BY ReviewTime ASC");
$ReviewStmt -> execute(["MovieId" => $_GET["MovieId"]]);
$ReviewResult = $ReviewStmt->fetchAll();

$view["review"] = $ReviewResult;
$view['MovieId'] = $_GET['MovieId'];

// print_r($userResult);

$twig->display('review.html.twig', context: $view );