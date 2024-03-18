<?php
require_once 'functions.php';
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
    exit();
}

$id = safeConnect();

$idt = isset($_GET['idt']) ? (int) $_GET['idt'] : 0; 

if ($idt > 0) {
    $stmt = $id->prepare("DELETE FROM tache WHERE idt = ? AND auteur = ?");
    $stmt->bind_param("is", $idt, $_SESSION['pseudo']); 
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        $_SESSION['message'] = 'La tâche a été supprimée avec succès.';
    } else {
        $_SESSION['message'] = 'Erreur ou permission non accordée pour supprimer cette tâche.';
    }
    $stmt->close();
} 

header("Location: dashboard.php");
?>
