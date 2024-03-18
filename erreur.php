<?php
session_start();
header("refresh:2;url=connexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Erreur</title>
    <?php include 'navbar.php'; ?>
    <link href="style.css" rel="stylesheet">
</head>
<body class="cyber-theme">
    <div class="container">
        <p>Erreur de pseudo ou de mot de passe. Vous serez redirigé dans quelques secondes...</p>
    </div>
</body>
</html>
