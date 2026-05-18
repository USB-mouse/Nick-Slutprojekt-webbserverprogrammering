<?php
require_once('../../../Slutprojekt-app.php');


if (!isset($_SESSION['UserId'])) {
    header("Location: index.php"); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movieId = $_POST['MovieId'] ?? null;
    $userId = $_SESSION['UserId'];

    if ($movieId) {
        
        $stmt = $pdo->prepare("DELETE FROM Watchlist WHERE MovieId = :MovieId AND UserId = :UserId");
        $stmt->execute([
            'MovieId' => $movieId,
            'UserId'  => $userId
        ]);
    }
}

header("Location: watchlist.php");
exit;