<?php
require_once('../../Slutprojekt-app.php');
$movieStmt = $pdo->prepare("SELECT * FROM MOVIES");
$movieStmt -> execute();
$movieResult = $movieStmt->fetchAll();

$userId = $_SESSION['UserId'];

$watchlistStmt = $pdo->prepare("SELECT * FROM WATCHLIST JOIN Movies on Watchlist.MovieId = Movies.MovieId WHERE Watchlist.UserId = :UserId ORDER BY DateAdded ASC");
$watchlistStmt -> execute([
    'UserId' => $userId
]);
$watchlistResult = $watchlistStmt->fetchAll();

v

$view["watchlist"] = $watchlistResult;




$view["movies"] = $movieResult;




$twig->display('Main.html.twig', context: $view);