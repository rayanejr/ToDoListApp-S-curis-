<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
    exit();
}

$id = mysqli_connect("db", "user", "password", "bd");
$pseudo = $_SESSION['pseudo'];
$message = ''; 

$user = ['nom' => '', 'prenom' => '', 'mail' => '', 'photo' => '']; 

$req = "SELECT nom, prenom, mail, photo FROM users WHERE pseudo='$pseudo'";
$result = mysqli_query($id, $req);
if ($result) {
    $fetchedUser = mysqli_fetch_assoc($result);
    if ($fetchedUser) {
        $user = $fetchedUser;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($id, $_POST['nom']);
    $prenom = mysqli_real_escape_string($id, $_POST['prenom']);
    $mail = mysqli_real_escape_string($id, $_POST['mail']);
    $photoUpdate = '';

    if (!empty($_FILES['photo']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['photo']['name']);
        $check = getimagesize($_FILES['photo']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
                $photoUpdate = ", photo='$target_file'";
            } else {
                $message .= 'Erreur lors du téléchargement de la photo.<br>';
            }
        } else {
            $message .= 'Le fichier n\'est pas une image.<br>';
        }
    }

    $updateQuery = "UPDATE users SET nom='$nom', prenom='$prenom', mail='$mail' $photoUpdate WHERE pseudo='$pseudo'";

    if (!empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])) {
        if ($_POST['newPassword'] === $_POST['confirmPassword']) {
            $newPassword = mysqli_real_escape_string($id, $_POST['newPassword']);
            
            $updateQuery = "UPDATE users SET nom='$nom', prenom='$prenom', mail='$mail', mdp='$newPassword' $photoUpdate WHERE pseudo='$pseudo'";
        } else {
            $message .= 'Les mots de passe ne correspondent pas.<br>';
        }
    }

    if (!$message) { 
        if (mysqli_query($id, $updateQuery)) {
            $message = 'Votre profil a été mis à jour avec succès.';
        } else {
            $message = 'Erreur lors de la mise à jour du profil.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le profil</title>
    <?php include 'navbar.php'; ?>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Modifier le profil</h1>
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom'] ?? ''); ?>"><br>
            Prénom: <input type="text" name="prenom" value="<?php echo htmlspecialchars($user['prenom'] ?? ''); ?>"><br>
            Email: <input type="email" name="mail" value="<?php echo htmlspecialchars($user['mail'] ?? ''); ?>"><br>
            Nouveau mot de passe: <input type="password" name="newPassword"><br>
            Confirmer le mot de passe: <input type="password" name="confirmPassword"><br>
            Photo: <input type="file" name="photo" accept="image/*"><br>
            <input type="submit" value="Mettre à jour">
        </form>
        <?php if (!empty($user['photo'])): ?>
            <div>
                <h2>Photo actuelle :</h2>
                <img src="<?php echo htmlspecialchars($user['photo'] ?? ''); ?>" alt="Photo de profil" style="max-width:200px;">
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
