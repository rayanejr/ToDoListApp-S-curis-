<?php
require 'functions.php';
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
    exit();
}
$connection = safeConnect();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["idt"])) {
    $idt = sanitizeInput($_GET["idt"], $connection);
    $nouvelleTache = sanitizeInput($_POST["tache"], $connection);
    $req = "UPDATE tache SET tache = ? WHERE idt = ?";
    $stmt = $connection->prepare($req);
    $stmt->bind_param("si", $nouvelleTache, $idt);
    $stmt->execute();
    header("Location: dashboard.php");
} else if(isset($_GET["idt"])) {
    $idt = sanitizeInput($_GET["idt"], $connection);
    $req = "SELECT tache FROM tache WHERE idt = ?";
    $stmt = $connection->prepare($req);
    $stmt->bind_param("i", $idt);
    $stmt->execute();
    $result = $stmt->get_result();
    $tache = $result->fetch_assoc();
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
            Tâche: <input type="text" name="tache" value="<?php echo htmlspecialchars($tache['tache'] ?? ''); ?>"><br>
            <input type="submit" value="Mettre à jour">
        </form>
    </div>
</body>
</html>
