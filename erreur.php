<?php
// Démarrage ou récupération de la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
header("refresh:2;url=connexion.php"); // Redirige l'utilisateur vers la page de connexion après 2 secondes
?>
<!DOCTYPE html>
<html lang="fr"> <!-- Modification de la langue pour maintenir la cohérence -->
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
