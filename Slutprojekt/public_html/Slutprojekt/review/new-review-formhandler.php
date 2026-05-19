<?php
date_default_timezone_set('Europe/Stockholm');
require_once('../../../Slutprojekt-app.php');

$messages = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 $ReviewTime = date('Y-m-d H:i:s'); 
// Har formuläret fyllts i?
if (empty($_POST["ReviewTitle"]) || empty($_POST["ReviewContent"])) {
    $messages[] = "The form is not filled out correctly!";
} 
$titleLength = strlen($_POST['ReviewTitle']);
$contentLength = strlen($_POST['ReviewContent']);

if ($titleLength > 20) {
    $messages[] = "Your title is too long ($titleLength characters). Maximum length is 20 characters.";
    }
if ($contentLength > 300) {
    $messages[] = "Your content is too long ($contentLength characters). Maximum length is 300 characters.";
    }

if (empty($messages)) {
$stmt = $pdo->prepare('INSERT INTO Reviews (ReviewTitle, ReviewContent, MovieId, Rating, ReviewTime, UserId) VALUES (:ReviewTitle, :ReviewContent, :MovieId, :Rating, :ReviewTime, :UserId)');
$stmt->execute([

    'ReviewTitle' => $_POST['ReviewTitle'], 
    'ReviewContent' => $_POST ['ReviewContent'],
    'MovieId' => $_POST['MovieId'],
    'Rating' => $_POST['Rating'],
    'ReviewTime' => $ReviewTime,
    'UserId' => $_POST['UserId'],
]);

header("Location: review.php?MovieId=" . $_POST['MovieId']);
    exit; 
}
else {
     echo "<h3>Something went wrong:</h3>";
    foreach ($messages as $error) {
        echo "<li>$error</li>";
        }
        echo "<br><button onclick='history.back()'>Go back and change</button>";
    
        exit; 
    }
}
