<?php
/**
 * Établit une connexion sécurisée à la base de données.
 * Retourne l'objet mysqli de la connexion.
 */
function safeConnect() {
    $hostname = 'db'; 
    $username = 'user';
    $password = 'password'; 
    $database = 'bd'; 

    $connection = new mysqli($hostname, $username, $password, $database);

    if ($connection->connect_error) {
        die("Échec de la connexion : " . $connection->connect_error);
    }

    mysqli_set_charset($connection, "utf8mb4");

    return $connection;
}

/**
 * Assainit l'entrée pour prévenir les attaques XSS.
 * Échappe les caractères spéciaux d'une chaîne pour l'utiliser dans une instruction SQL.
 *
 * @param string $data Les données à assainir.
 * @param mysqli $connection L'objet de connexion à la base de données.
 * @return string Les données assainies.
 */
function sanitizeInput($data, $connection = null) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($connection) {
        $data = mysqli_real_escape_string($connection, $data);
    }
    return $data;
}
