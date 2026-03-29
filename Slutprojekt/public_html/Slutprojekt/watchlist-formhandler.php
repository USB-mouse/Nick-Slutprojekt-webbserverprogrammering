<?php
require_once('../../Slutprojekt-app.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    $movieId = $_POST['MovieId'] ?? null;
    $userId = $_POST['UserId'] ?? null;


  
    if (!empty($movieId) && !empty($userId)) {
        
       
        $stmt = $pdo->prepare('INSERT INTO Watchlist (UserId, MovieId) VALUES (:UserId, :MovieId)');
        
       
        $stmt->execute([
            'UserId'  => $userId,
            'MovieId' => $movieId
            
        ]);
    }

   
    header("Location: info.php?MovieId=" . $movieId);
    exit; 
}
