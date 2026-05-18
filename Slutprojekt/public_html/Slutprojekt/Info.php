<?php
require_once('../../Slutprojekt-app.php');



$movieStmt = $pdo->prepare("SELECT * FROM MOVIES WHERE MovieId = :MovieId");
$movieStmt -> execute(["MovieId" => $_GET["MovieId"]]);
$movieResult = $movieStmt->fetchAll();


$LkStmt = $pdo->prepare("SELECT * FROM Movies WHERE Genre = :genre AND MovieId != :MovieId LIMIT 3");
$LkStmt->execute([
    'genre'   => $_GET["genre"],
    'MovieId' => $_GET['MovieId']
]);

$LkResult = $LkStmt->fetchAll();

$view["Lkmovies"] = $LkResult;
    

$view['genre'] = $_GET['genre'];
$_SESSION['UserId'] ?? null;

$view["movies"] = $movieResult;

$view['UserId'] = $_SESSION['UserId'] ?? null;
$view['MovieId'] = $_GET['MovieId'];




$twig->display('info.html.twig', context: $view);