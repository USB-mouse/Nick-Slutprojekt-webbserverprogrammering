<?php
require_once('../../Slutprojekt-app.php');
$movieStmt = $pdo->prepare("SELECT * FROM MOVIES");
$movieStmt -> execute();
$movieResult = $movieStmt->fetchAll();

$watchlistStmt = $pdo->prepare("SELECT * FROM WATCHLIST JOIN Movies on Watchlist.MovieId = Movies.MovieId ORDER BY DateAdded ASC");
$watchlistStmt -> execute();
$watchlistResult = $watchlistStmt->fetchAll();


$view["watchlist"] = $watchlistResult;


h

$view["movies"] = $movieResult;




$twig->display('Main.html.twig', context: $view);