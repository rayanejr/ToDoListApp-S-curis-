<?php
require 'functions.php';
session_start();

if (isset($_POST["bouton"])) {
    $connection = safeConnect();

    $nom = sanitizeInput($_POST["nom"], $connection);
    $prenom = sanitizeInput($_POST["prenom"], $connection);
    $mail = sanitizeInput($_POST["mail"], $connection);
    $pseudo = sanitizeInput($_POST["pseudo"], $connection);
    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);

    if (!empty($_FILES["photo"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false && in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $uploadSuccess = true;
            } else {
                echo "Erreur de téléchargement de la photo.";
                $uploadSuccess = false;
                exit;
            }
        } else {
            echo "Le fichier n'est pas une image valide.";
            exit;
        }
    } else {
        $target_file = "";
    }

    $req = "INSERT INTO users (nom, prenom, mail, pseudo, mdp, photo) 
            VALUES ('$nom', '$prenom', '$mail', '$pseudo', '$mdp', '$target_file')";
    if(mysqli_query($connection, $req)) {
        header("location:index.php");
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <?php include 'navbar.php'; ?>
    <link href="style.css" rel="stylesheet">
</head>
<body class="cyber-theme">
    <div class="container">
        <h1>Inscription</h1>
        <form action="" method="post" enctype="multipart/form-data">
            Nom*: <input type="text" name="nom" required><br><br>
            Prénom*: <input type="text" name="prenom" required><br><br>
            Email*: <input type="email" name="mail" required><br><br>
            Pseudo*: <input type="text" name="pseudo" required><br><br>
            Mot de passe*: <input type="password" name="mdp" required><br><br>
            Photo de profil: <input type="file" name="photo" accept="image/*"><br><br>
            <input type="submit" value="S'inscrire" name="bouton">
        </form>
        <br><br>
        <p>Vous avez déjà un compte? <a href="connexion.php">Connectez-vous ici</a>.</p>
    </div>
</body>
</html>
