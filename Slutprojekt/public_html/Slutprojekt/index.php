<?php
require_once('../../Slutprojekt-app.php');
//grunden av att hämta 
$sql = "SELECT * FROM Movies";
//vi ska kunna se om man har tryckt på en filter 
$sort = $_GET['sort'] ?? '';


if ($sort === 'newest') {
    $sql .= " ORDER BY DateAdded DESC";
} elseif ($sort === 'al') {
    $sql .= " ORDER BY Title ASC";
}

$movieStmt = $pdo->prepare($sql);
$movieStmt -> execute();
$movieResult = $movieStmt->fetchAll();


$view['movies'] = $movieResult;
    

$userId = $_SESSION['UserId'] ?? '';

$watchlistStmt = $pdo->prepare("SELECT * FROM WATCHLIST JOIN Movies on Watchlist.MovieId = Movies.MovieId WHERE Watchlist.UserId = :UserId ORDER BY DateAdded DESC");
$watchlistStmt -> execute([
    'UserId' => $userId
]);
$watchlistResult = $watchlistStmt->fetchAll();


$view["watchlist"] = $watchlistResult;

$view["movies"] = $movieResult;


$twig->display('Main.html.twig', context: $view);