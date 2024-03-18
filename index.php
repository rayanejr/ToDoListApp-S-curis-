<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'navbar.php';?>
    <link href="style.css" rel="stylesheet">
</head>
<body class="cyber-theme"> 
    <div class="container">
        <h1>Bienvenue dans le Gestionnaire de Tâches Cybernétique</h1>
        <p>Bienvenue sur la page d'accueil de notre projet de gestionnaire de tâches. Ce projet vise à fournir une plateforme conviviale pour gérer efficacement vos tâches quotidiennes avec une touche cybernétique.</p>
        <div class="buttons">
            <?php if (isset($_SESSION['pseudo'])): ?>
                <a href="modifier_profil.php" class="btn">Modifier Mon Profil</a>
                <a href="dashboard.php" class="btn">Voir Mes Tâches</a>
                <a href="deconnexion.php" class="btn">Déconnexion</a>
            <?php else: ?>
                <a href="connexion.php" class="btn">Connexion</a>
                <a href="inscription.php" class="btn">Inscription</a>
                <a href="dashboard.php" class="btn">Voir les Tâches Publiques</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
