<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('../../Slutprojekt-app.php');

$title = $_POST['Title'];

$SearchStmt = $pdo->prepare("SELECT * FROM Movies WHERE Title LIKE '$title%'");
$SearchStmt -> execute();
$SearchResult = $SearchStmt->fetchAll();



$view["movies"] = $SearchResult;




$twig->display('search.html.twig', context: $view );