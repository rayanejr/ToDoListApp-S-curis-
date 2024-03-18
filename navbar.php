<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
?>
<nav class="cyber-theme">
    <div class="container">
        <a href="index.php">Gestionnaire de Tâches Cybernétique</a>
        <?php if (isset($_SESSION['pseudo'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="modifier_profil.php">Modifier Profil</a>
            <a href="deconnexion.php">Déconnexion</a>
        <?php else: ?>
            <a href="connexion.php">Connexion</a>
            <a href="inscription.php">Inscription</a>
            <a href="dashboard.php">Voir les Tâches Publiques</a>
        <?php endif; ?>
    </div>
</nav>
