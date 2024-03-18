<?php
session_start();
if (isset($_POST["bouton"])) {
    $id = mysqli_connect("db", "user", "password", "bd");
    $pseudo = $_POST["pseudo"]; 
    $mdp = $_POST["mdp"]; 
    $req = "SELECT * FROM users WHERE pseudo='$pseudo' AND mdp='$mdp'";
    $resultat = mysqli_query($id, $req);
    if (mysqli_num_rows($resultat) > 0) {
        $_SESSION["pseudo"] = $pseudo; 
        header("location:dashboard.php");
    } else {
        header("location:erreur.php");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <?php include 'navbar.php'; ?>
    <link href="style.css" rel="stylesheet">
</head>
<body class="cyber-theme">
    <div class="container">
        <h1>Connexion</h1>
        <form action="" method="post">
            Pseudo*: <input type="text" name="pseudo" required><br><br>
            Mot de passe*: <input type="password" name="mdp" required><br><br>
            <input type="submit" value="Valider" name="bouton"><br><br>
        </form><br><br>
        <p>Pas encore inscrit? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
    </div>
</body>
</html>
