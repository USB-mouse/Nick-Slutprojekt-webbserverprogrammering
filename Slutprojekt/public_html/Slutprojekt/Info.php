<?php
require_once('../../Slutprojekt-app.php');

$genre = $_SESSION["genre"];

$movieStmt = $pdo->prepare("SELECT * FROM MOVIES WHERE MovieId = :MovieId");
$movieStmt -> execute(["MovieId" => $_GET["MovieId"]]);
$movieResult = $movieStmt->fetchAll();

$LkStmt = $pdo->prepare("SELECT * FROM MOVIES WHERE Genre = :genre");
$LkStmt -> execute(['genre' => $_SESSION['genre']]);
$LkResult = $LkStmt->fetchAll();



$LkStmt = $pdo->prepare("SELECT * FROM Movies WHERE Genre = :genre AND MovieId != :MovieId LIMIT 5");
$LkStmt->execute([
    'genre'   => $movieResult['Genre'],
    'MovieId' => $_GET['MovieId'] ?? null
]);

$LkResult = $LkStmt->fetchAll();

$view['genre']= $movieResult['Genre'];
    



$view['genre'] = $LkResult;
$_SESSION['UserId'] ?? null;

$view["movies"] = $movieResult;

$view['UserId'] = $_SESSION['UserId'] ?? null;
$view['MovieId'] = $_GET['MovieId'];




$twig->display('info.html.twig', context: $view);