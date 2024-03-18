<?php
session_start();
session_destroy();
header("Location: index.php");
exit();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <?php include 'navbar.php'; ?>
    <link href="style.css" rel="stylesheet">
</head>
<body class="cyber-theme"> 
    <div class="container">
        <p>Vous avez été déconnecté. Vous allez être redirigé vers la page d'accueil.</p>
    </div>
</body>
</html>
