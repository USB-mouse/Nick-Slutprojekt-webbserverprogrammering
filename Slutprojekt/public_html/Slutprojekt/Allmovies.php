<?php
require_once('../../Slutprojekt-app.php');
//grunden av att hämta 
$sql = "SELECT * FROM Movies";
$execute = [];
//vi ska kunna se om man har tryckt på en filter 
$sort = $_GET['sort'] ?? '';
$genre = $_GET['genre'] ?? '';

if ($genre != '') {
    $sql .= " WHERE Genre = :genre";
    $execute['genre'] = $genre;
}

//sorterar på vad man har tryckt med get 
if ($sort === 'newest') {
    $sql .= " ORDER BY DateAdded DESC";
} elseif ($sort === 'al') {
    $sql .= " ORDER BY Title ASC";
}



$movieStmt = $pdo->prepare($sql);
$movieStmt -> execute($execute);
$movieResult = $movieStmt->fetchAll();

$view['movies'] = $movieResult;

$view['sort'] = $sort;
$view['genre'] = $genre;

$twig->display('Allmovies.html.twig', context: $view);