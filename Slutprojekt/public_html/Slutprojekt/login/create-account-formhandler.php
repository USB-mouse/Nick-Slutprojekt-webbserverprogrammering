<?php

require_once('../../../Slutprojekt-app.php');

$messages = array();

// Har formuläret fyllts i? (empty kollar att värdet finns och inte är tomt, d.v.s. 0 eller "")
if (empty($_POST["Username"]) || empty($_POST["Password"]) || empty($_POST["Username"]) || empty($_POST['Password']) || empty($_POST['repeated-password'])) {
    $messages[] = "Formuläret är inte korrekt ifyllt!";

} else {

    // Kolla om lösenorden är likadana
    if ($_POST["Password"] != $_POST["repeated-password"]) {
        $messages[] = "Lösenorden var inte samma!";
    } else {

        // Kolla att användarnamnet inte redan finns i databasen
        $checkUsernameStmt = $pdo->prepare("SELECT * FROM Users WHERE Username = :Username");
        $checkUsernameStmt->execute([
            "Username" => $_POST["Username"]
        ]);

        $checkUsernameResult = $checkUsernameStmt->fetch(PDO::FETCH_ASSOC);
        if ($checkUsernameResult != false) {
            $messages[] = "Användarnamnet är upptaget!";

        } else {
            $newTeacherStmt = $pdo->prepare("INSERT INTO Users (Username, Password) VALUES (:Username, :Password)");
            $newTeacherStmt->execute([
                "Username" => $_POST["Username"],
                "Password" => password_hash(password:$_POST["Password"], algo: PASSWORD_DEFAULT)
            ]);

            $messages[] = "Det nya kontot har skapats!";

        }
            
    }

}


require($includeDir . "/header.php");
?>

<main>

    <h2>Nytt konto</h2>
    <?php foreach ($messages as $key => $value): ?>
        <div><?= $value ?></div>
    <?php endforeach; ?>

</main>

<?php require($includeDir . "/footer.php"); ?>