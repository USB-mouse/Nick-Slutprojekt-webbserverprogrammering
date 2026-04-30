<?php
require_once('../../Slutprojekt-app.php');

date_default_timezone_set('Europe/Stockholm');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    

    $movieId = $_POST['MovieId'] ?? null;
    $userId = $_POST['UserId'] ?? null;
    $dateAdded = date('Y-m-d H:i:s'); 

  
    if (!empty($movieId) && !empty($userId)) {
        
     
        $checkStmt = $pdo->prepare('SELECT * FROM Watchlist WHERE UserId = :UserId AND MovieId = :MovieId');
        $checkStmt->execute([
            'UserId' => $userId,
            'MovieId' => $movieId
        ]);

        $alreadyExists = $checkStmt->fetch();

        if (!$alreadyExists) {

        $stmt = $pdo->prepare('INSERT INTO Watchlist (UserId, MovieId, DateAdded) VALUES (:UserId, :MovieId, :DateAdded)');
        
       
        $stmt->execute([
            'UserId'  => $userId,
            'MovieId' => $movieId,
            'DateAdded' => $dateAdded
            
        ]);
        }
    }
    

   
    header("Location: info.php?MovieId=" . $movieId);
    exit; 
}


