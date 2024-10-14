<?php

session_start();
// require_once(__DIR__ . '/isConnect.php');
$pdo = require_once '../db/databaseConnect.php';
require_once '../config/fonctions.php';
require_once '../functions/messsage.php';

$postData = $_POST;


if (!$pdo) {
    echo "Erreur lors de la connexion à la base de données";
    exit;
}


// Vérification des champs de notre formulaire d'ajout
if (!isset($_POST['recipe_id']) || !is_numeric($_POST['recipe_id'])) {

    echo "il manque l'id de la recette pour permettre la suppression au niveau du formulaire";

    var_dump($_POST); // Afficher le contenu de $_POST

    return;
}


$id =  $_POST['recipe_id'];

echo $id;


try {
    $deleteRecipeStatement = $pdo->prepare('DELETE from recipes WHERE recipe_id = :id');
    $recetteDeletedSuccessfully = $deleteRecipeStatement->execute([
        'id' => $id
    ]);

    if ($recetteDeletedSuccessfully) {
        // Redirige vers la page de détails de la recette avec un paramètre de succès
        header("Location:" . BASE_URL . "index.php?toast=success");
        exit;
    } else {
        // Gérer l'erreur (facultatif)
        header("Location:" . BASE_URL . "index.php?toast=error");
        exit;
    }

    exit;
} catch (PDOException $e) {
    echo "Erreur lors de la suppression de la recette : " . $e->getMessage();
    exit;
}
