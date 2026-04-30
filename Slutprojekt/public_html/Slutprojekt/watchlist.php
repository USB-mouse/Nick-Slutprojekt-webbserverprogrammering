<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('../../Slutprojekt-app.php');

$userId = $_SESSION['UserId'] ?? '';

$watchlistStmt = $pdo->prepare("SELECT * FROM WATCHLIST JOIN Movies on Watchlist.MovieId = Movies.MovieId WHERE Watchlist.UserId = :UserId ORDER BY DateAdded DESC");
$watchlistStmt -> execute([
    'UserId' => $userId
]);
$watchlistResult = $watchlistStmt->fetchAll();


$view["watchlist"] = $watchlistResult;




$twig->display('watchlist.html.twig', context: $view );