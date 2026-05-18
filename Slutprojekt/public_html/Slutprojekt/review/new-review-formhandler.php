<?php
date_default_timezone_set('Europe/Stockholm');
require_once('../../../Slutprojekt-app.php');

$messages = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 $ReviewTime = date('Y-m-d H:i:s'); 
// Har formuläret fyllts i?
if (empty($_POST["ReviewTitle"]) || empty($_POST["ReviewContent"])) {
    $messages[] = "Formuläret är inte korrekt ifyllt!";
} 
$titleLength = strlen($_POST['ReviewTitle']);
$contentLength = strlen($_POST['ReviewContent']);

if ($titleLength > 20) {
    $messages[] = "Din titel är för lång ($titleLength tecken). Maxlängd är 20 tecken.";
    }
if ($contentLength > 400) {
    $messages[] = "Ditt innehåll är för långt ($contentLength tecken). Maxlängd är 400 tecken.";
    }


$stmt = $pdo->prepare('INSERT INTO Reviews (ReviewTitle, ReviewContent, MovieId, Rating, ReviewTime) VALUES (:ReviewTitle, :ReviewContent, :MovieId, :Rating, :ReviewTime)');
$stmt->execute([

    'ReviewTitle' => $_POST['ReviewTitle'], 
    'ReviewContent' => $_POST ['ReviewContent'],
    'MovieId' => $_POST['MovieId'],
    'Rating' => $_POST['Rating'],
    'ReviewTime' => $ReviewTime
]);


header("Location: review.php?MovieId=" . $_GET['MovieId']);
    exit; 

}
