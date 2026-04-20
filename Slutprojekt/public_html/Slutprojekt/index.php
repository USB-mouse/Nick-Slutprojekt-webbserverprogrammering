<?php
require_once('../../Slutprojekt-app.php');
$movieStmt = $pdo->prepare("SELECT * FROM MOVIES");
$movieStmt -> execute();
$movieResult = $movieStmt->fetchAll();

$movieStmt = "SELECT * FROM MOVIES";

/* if () {
    $movieStmt += "ORDER BY DateAdded DESC";
}
*/



    

$userId = $_SESSION['UserId'];

$watchlistStmt = $pdo->prepare("SELECT * FROM WATCHLIST JOIN Movies on Watchlist.MovieId = Movies.MovieId WHERE Watchlist.UserId = :UserId ORDER BY DateAdded DESC");
$watchlistStmt -> execute([
    'UserId' => $userId
]);
$watchlistResult = $watchlistStmt->fetchAll();


$view["watchlist"] = $watchlistResult;

$view["movies"] = $movieResult;


$twig->display('Main.html.twig', context: $view);