<?php
session_start();
$id = mysqli_connect("db", "user", "password", "bd");

if (isset($_POST['creer_tache']) && isset($_SESSION['pseudo'])) {
    $nom_tache = mysqli_real_escape_string($id, $_POST['nom_tache']);
    $etat_tache = mysqli_real_escape_string($id, $_POST['etat_tache']);
    $pseudo = mysqli_real_escape_string($id, $_SESSION['pseudo']);

    $req_insert = "INSERT INTO tache (tache, etat, auteur) VALUES ('$nom_tache', '$etat_tache', '$pseudo')";
    if (!mysqli_query($id, $req_insert)) {
        echo '<p>Erreur lors de la création de la tâche.</p>';
    }
}

$reqPublic = "SELECT * FROM tache";
$resPublic = mysqli_query($id, $reqPublic);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <?php include 'navbar.php'; ?>
    <link href="style.css" rel="stylesheet">
</head>
<body class="cyber-theme">
    <div class="container">
        <h1>Tableau de Bord</h1>

        <?php if (isset($_SESSION['pseudo'])): ?>
            <h2>Créer une nouvelle tâche</h2>
            <form action="" method="post">
                Nom de la tâche: <input type="text" name="nom_tache"><br>
                État de la tâche: 
                <select name="etat_tache">
                    <option value="en attente">En attente</option>
                    <option value="en cours">En cours</option>
                    <option value="terminé">Terminé</option>
                </select><br>
                <input type="submit" name="creer_tache" value="Créer la tâche">
            </form>

            <h2>Vos Tâches</h2>
            <?php
            $pseudo = $_SESSION['pseudo'];
            $reqPrivate = "SELECT * FROM tache WHERE auteur='$pseudo'";
            $resPrivate = mysqli_query($id, $reqPrivate);
            ?>

            <table>
                <tr>
                    <th>Tâche</th>
                    <th>État</th>
                    <th>Actions</th>
                </tr>
                <?php while ($ligne = mysqli_fetch_assoc($resPrivate)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ligne['tache']); ?></td>
                    <td><?php echo htmlspecialchars($ligne['etat']); ?></td>
                    <td>
                        <a href="modifier_details_tache.php?idt=<?php echo $ligne['idt']; ?>">Modifier</a> | 
                        <a href="modifier_etat_tache.php?idt=<?php echo $ligne['idt']; ?>">Changer État</a> | 
                        <a href="supprimer_tache.php?idt=<?php echo $ligne['idt']; ?>">Supprimer</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>

        <h2>Tâches Publiques</h2>
        <table>
            <tr>
                <th>Tâche</th>
                <th>État</th>
                <th>Auteur</th>
            </tr>
            <?php while ($ligne = mysqli_fetch_assoc($resPublic)): ?>
            <tr>
                <td><?php echo htmlspecialchars($ligne['tache']); ?></td>
                <td><?php echo htmlspecialchars($ligne['etat']); ?></td>
                <td><?php echo htmlspecialchars($ligne['auteur']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
