<?php
require 'functions.php';
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
    exit();
}

$connection = safeConnect();
$pseudo = $_SESSION['pseudo'];
$message = '';

$user = ['nom' => '', 'prenom' => '', 'mail' => '', 'photo' => ''];

$stmt = $connection->prepare("SELECT nom, prenom, mail, photo FROM users WHERE pseudo=?");
$stmt->bind_param("s", $pseudo);
$stmt->execute();
$result = $stmt->get_result();
if ($fetchedUser = $result->fetch_assoc()) {
    $user = $fetchedUser;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = sanitizeInput($_POST['nom'], $connection);
    $prenom = sanitizeInput($_POST['prenom'], $connection);
    $mail = sanitizeInput($_POST['mail'], $connection);
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

    $updateQuery = "UPDATE users SET nom=?, prenom=?, mail=? $photoUpdate WHERE pseudo=?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param("ssss", $nom, $prenom, $mail, $pseudo);

    if (!empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])) {
        if ($_POST['newPassword'] === $_POST['confirmPassword']) {
            $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            $updateQuery = "UPDATE users SET nom=?, prenom=?, mail=?, mdp=? $photoUpdate WHERE pseudo=?";
            $stmt = $connection->prepare($updateQuery);
            $stmt->bind_param("sssss", $nom, $prenom, $mail, $newPassword, $pseudo);
        } else {
            $message .= 'Les mots de passe ne correspondent pas.<br>';
        }
    }

    if (!$message && $stmt->execute()) {
        $message = 'Votre profil a été mis à jour avec succès.';
    } else {
        $message .= 'Erreur lors de la mise à jour du profil.';
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
            Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>"><br>
            Prénom: <input type="text" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>"><br>
            Email: <input type="email" name="mail" value="<?php echo htmlspecialchars($user['mail']); ?>"><br>
            Nouveau mot de passe: <input type="password" name="newPassword"><br>
            Confirmer le mot de passe: <input type="password" name="confirmPassword"><br>
            Photo: <input type="file" name="photo" accept="image/*"><br>
            <input type="submit" value="Mettre à jour">
        </form>
        <?php if (!empty($user['photo'])): ?>
            <div>
                <h2>Photo actuelle :</h2>
                <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Photo de profil" style="max-width:200px;">
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
