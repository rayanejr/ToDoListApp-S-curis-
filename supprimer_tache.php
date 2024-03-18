<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
    exit();
}

$id = mysqli_connect("db", "user", "password", "bd");

if (isset($_GET['idt'])) {
    $idt = $_GET['idt']; 

    $req = "DELETE FROM tache WHERE idt=$idt";
    mysqli_query($id, $req);

    header("Location: dashboard.php");
} else {
    header("Location: dashboard.php");
}
?>
