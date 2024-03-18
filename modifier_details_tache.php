<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
    exit();
}
$id = mysqli_connect("db", "user", "password", "bd");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $idt = $_GET["idt"];
    $nouvelleTache = $_POST["tache"]; 
    $req = "UPDATE tache SET tache='$nouvelleTache' WHERE idt=$idt";
    mysqli_query($id, $req);
    header("Location: dashboard.php");
} else {
    $idt = $_GET["idt"]; 
    $req = "SELECT tache FROM tache WHERE idt=$idt";
    $result = mysqli_query($id, $req);
    $tache = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modification des tâches</title>
    <?php include 'navbar.php'; ?>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div>
        <h1>Modifier la tâche</h1>
        <form action="" method="post">
            <input type="text" name="tache" value="<?php echo htmlspecialchars($tache['tache']); ?>">
            <input type="submit" value="Mettre à jour">
        </form>
    </div>
</body>
</html>
