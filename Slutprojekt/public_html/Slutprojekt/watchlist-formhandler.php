<?php
require_once('../../Slutprojekt-app.php');

date_default_timezone_set('Europe/Stockholm');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    

    $movieId = $_POST['MovieId'] ?? null;
    $userId = $_POST['UserId'] ?? null;
    $dateAdded = date("d/m-Y h:i"); 

  
    if (!empty($movieId) && !empty($userId)) {
        
     
        $stmt = $pdo->prepare('INSERT INTO Watchlist (UserId, MovieId, DateAdded) VALUES (:UserId, :MovieId, :DateAdded)');
        
       
        $stmt->execute([
            'UserId'  => $userId,
            'MovieId' => $movieId,
            'DateAdded' => $dateAdded
            
        ]);
    }

   
    header("Location: info.php?MovieId=" . $movieId);
    exit; 
}


