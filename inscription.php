<?php
session_start();

if (isset($_POST["bouton"])) {
    $id = mysqli_connect("db", "user", "password", "bd");
    mysqli_set_charset($id, "utf8");

    $nom = mysqli_real_escape_string($id, $_POST["nom"]);
    $prenom = mysqli_real_escape_string($id, $_POST["prenom"]);
    $mail = mysqli_real_escape_string($id, $_POST["mail"]);
    $pseudo = mysqli_real_escape_string($id, $_POST["pseudo"]);
    $mdp = mysqli_real_escape_string($id, $_POST["mdp"]); 

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    $req = "INSERT INTO users (nom, prenom, mail, pseudo, mdp, photo) 
            VALUES ('$nom', '$prenom', '$mail', '$pseudo', '$mdp', '$target_file')";
    mysqli_query($id, $req);

    header("location:index.php");
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
        <p>Vous avez déja un compte? <a href="connexion.php">Connectez-vous ici</a>.</p>
    </div>
</body>
</html>
