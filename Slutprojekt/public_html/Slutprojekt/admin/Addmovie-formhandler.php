<?php
date_default_timezone_set('Europe/Stockholm');
require_once('../../../Slutprojekt-app.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messages = [];
    
    $dateAdded = date('Y-m-d H:i:s');

  //kolla om nåt är tomt
    if (empty($_POST['Title']) || empty($_POST['ReleaseYear']) || empty($_POST['Genre']) || empty($_POST['Director']) || empty($_POST['Summery'])) {
        $messages[] = "Need to fill them bro";
    }

    if (empty($messages)) {
        
        $stmt = $pdo->prepare('INSERT INTO Movies (Title, ReleaseYear, Genre, Director, Cover, Summery, MovieDateAdded) VALUES (:Title, :ReleaseYear, :Genre, :Director, :Cover, :Summery, :MovieDateAdded)');
        
        $stmt->execute([
            'Title'       => $_POST['Title'],
            'ReleaseYear' => $_POST['ReleaseYear'],
            'Genre'       => $_POST['Genre'],
            'Director'    => $_POST['Director'],
            'Cover'       => $_POST['Cover'],
            'Summery'     => $_POST['Summery'],
            'MovieDateAdded'   => $dateAdded
        ]);

        header("Location: ../index.php");
        exit;

    } 
    else {
     echo "<h3>Something went wrong:</h3>";
    foreach ($messages as $error) {
        echo "<li>$error</li>";
        }
        echo "<br><button onclick='history.back()'>Go back</button>";
    
        exit; 
    }
}