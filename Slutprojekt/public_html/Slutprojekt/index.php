<?php
require_once('../../Slutprojekt-app.php');


// Fasta listor som inte kräver någon ändring
/*
$topRatedStmt = $pdo->prepare("SELECT * FROM Movies ORDER BY Rating DESC LIMIT 3");
$topRatedStmt->execute();
$topRatedMovies = $topRatedStmt->fetchAll();
*/
$classicsStmt = $pdo->prepare("SELECT * FROM Movies ORDER BY ReleaseYear ASC LIMIT 3");
$classicsStmt->execute();
$classicMovies = $classicsStmt->fetchAll();

$newestStmt = $pdo->prepare("SELECT * FROM Movies ORDER BY MovieDateAdded DESC");
$newestStmt->execute();
$newestMovies = $newestStmt->fetchAll();


$view['top_rated'] = $topRatedMovies;
$view['classics'] = $classicMovies;
$view['newest'] = $newestMovies;

// variande lista 

//grunden av att hämta 
$sql = "SELECT * FROM Movies";
//vi ska kunna se om man har tryckt på en filter 
$sort = $_GET['sort'] ?? '';
$type = $_GET['genre'] ?? '';

if ($sort === 'newest') {
    $sql .= " ORDER BY MovieDateAdded DESC";
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



$twig->display('Main.html.twig', context: $view);