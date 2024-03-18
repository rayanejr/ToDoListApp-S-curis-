<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
    exit();
}
$id = mysqli_connect("db", "user", "password", "bd");

if (isset($_GET["idt"])) {
    
    $idt = $_GET["idt"];
    $req = "SELECT etat FROM tache WHERE idt=$idt";
    $result = mysqli_query($id, $req);
    $tache = mysqli_fetch_assoc($result);

    $nouvelEtat = ($tache['etat'] === 'en attente') ? 'en cours' : (($tache['etat'] === 'en cours') ? 'terminé' : 'en attente');
    $req = "UPDATE tache SET etat='$nouvelEtat' WHERE idt=$idt";
    mysqli_query($id, $req);

    header("Location: dashboard.php");
}
