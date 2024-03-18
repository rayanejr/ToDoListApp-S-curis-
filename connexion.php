<?php
session_start();
include 'functions.php';

if (isset($_POST["bouton"])) {
    $id = safeConnect();

    $pseudo = sanitizeInput($_POST["pseudo"], $id);
    $mdp = sanitizeInput($_POST["mdp"], $id);

    $stmt = $id->prepare("SELECT * FROM users WHERE pseudo = ?");
    $stmt->bind_param("s", $pseudo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($mdp, $user['mdp'])) {
            $_SESSION["pseudo"] = $user['pseudo']; 
            header("location:dashboard.php");
        } else {
            $_SESSION['error'] = "Mot de passe incorrect.";
            header("location:erreur.php");
        }
    } else {
        $_SESSION['error'] = "Utilisateur non trouvé.";
        header("location:erreur.php");
    }
    $stmt->close();
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
