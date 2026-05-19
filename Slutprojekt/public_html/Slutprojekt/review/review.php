<?php
require_once('../../../Slutprojekt-app.php');


$ReviewStmt = $pdo->prepare("SELECT * FROM Reviews JOIN Users on Reviews.UserId = Users.UserId  WHERE MovieId = :MovieId ORDER BY ReviewTime DESC");
$ReviewStmt -> execute(["MovieId" => $_GET["MovieId"]]);
$ReviewResult = $ReviewStmt->fetchAll();

$view["review"] = $ReviewResult;
$view['MovieId'] = $_GET['MovieId'];

// print_r($userResult);

$twig->display('review/review.html.twig', context: $view );