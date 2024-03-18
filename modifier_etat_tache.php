<?php
require 'functions.php';
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
    exit();
}
$connection = safeConnect();

if (isset($_GET["idt"])) {
    $idt = sanitizeInput($_GET["idt"], $connection);

    $stmt = $connection->prepare("SELECT etat FROM tache WHERE idt = ?");
    $stmt->bind_param("i", $idt);
    $stmt->execute();
    $result = $stmt->get_result();
    $tache = $result->fetch_assoc();

    $nouvelEtat = '';
    switch ($tache['etat']) {
        case 'en attente':
            $nouvelEtat = 'en cours';
            break;
        case 'en cours':
            $nouvelEtat = 'terminé';
            break;
        case 'terminé':
            $nouvelEtat = 'en attente';
            break;
    }

    $stmt = $connection->prepare("UPDATE tache SET etat = ? WHERE idt = ?");
    $stmt->bind_param("si", $nouvelEtat, $idt);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>
