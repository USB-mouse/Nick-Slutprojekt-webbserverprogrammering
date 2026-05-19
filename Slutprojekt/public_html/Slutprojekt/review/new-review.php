<?php
require_once('../../../Slutprojekt-app.php');


$ReviewStmt = $pdo->prepare("SELECT * FROM Reviews WHERE MovieId = :MovieId");
$ReviewStmt -> execute(["MovieId" => $_GET["MovieId"]]);
$ReviewResult = $ReviewStmt->fetchAll();

$view["review"] = $ReviewResult;

$view['MovieId'] = $_GET['MovieId'] ?? null;

$view['UserId'] = $_SESSION['UserId'] ?? null;

// print_r($userResult);

$twig->display('review/new-review.html.twig', context: $view );