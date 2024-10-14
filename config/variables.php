<!-- url -->
<?php

require_once __DIR__ . '/../db/databaseConnect.php'; 

define('BASE_URL', '/projets/resto-app-php/');

// Récupération des variables 

// On récupère la liste de tous les utilisateurs
$usersStatement = $pdo->prepare('SELECT * FROM users');
$usersStatement->execute();
$users = $usersStatement->fetchAll(PDO::FETCH_ASSOC);

// On récupère la liste des recettes dont l'état est actif
$recipesStatement = $pdo->prepare('SELECT *, views FROM recipes WHERE is_enabled IS TRUE');
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);
