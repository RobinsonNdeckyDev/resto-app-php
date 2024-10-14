<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/variables.php';

// require_once './db/databaseConnect.php';
// require_once './config/variables.php';

// afficher la liste des auteurs de recettes
function displayAuthor(string $authorEmail, array $users): string
{
    foreach ($users as $user) {
        if ($authorEmail === $user['email']) {
            return $user['prenom'] . '(' . $user['nom'] .')';
        }
    }
    return 'Auteur inconnu';
}

// Vérifier si une recette est valide
function isValidRecipe(array $recipe): bool
{
    if (array_key_exists('is_enabled', $recipe)) {
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }


    return $isEnabled;
}

// Récupérer les recettes valides
function getRecipes(array $recipes): array
{
    $valid_recipes = [];

    foreach ($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $valid_recipes[] = $recipe;
        }
    }

    // Retourner les recettes valides
    return $valid_recipes;
}

// Récupérer les recettes actives depuis la base de données
function getActiveRecipes(): array
{
    // Utiliser la connexion PDO globale
    global $pdo;

    if ($pdo === null) {
        die('Erreur : la connexion à la base de données a échoué.');
    }

    // Requête pour récupérer les recettes actives
    $sql = 'SELECT * FROM recipes WHERE is_enabled = TRUE';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Récupérer les résultats
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner uniquement les recettes valides
    return getRecipes($recipes);
}

// rediriger l'utilisateur vers une autre page
function redirectToUrl($url)
{
    header("Location: " . BASE_URL . $url);
    exit();
}

