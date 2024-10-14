<?php

// Connexion  à la base de donnees avec les méthodes PDO et mysqli

// Inclusion du fichier de configuration mysql.php
require_once 'mysql.php';


// conf PDO

global $pdo;

try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

    // Activation des erreurs lors de la connexion avec la base de données
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

return $pdo;
