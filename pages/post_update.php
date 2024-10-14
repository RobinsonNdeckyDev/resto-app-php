<?php

session_start();
// require_once(__DIR__ . '/isConnect.php');

$pdo = require_once '../db/databaseConnect.php';
require_once '../config/fonctions.php';
require_once '../config/variables.php';
require_once '../functions/messsage.php';


$postData = $_POST;


// Vérification des champs de notre formulaire d'ajout
if (!isset($postData['id']) || !isset($postData['title']) || !isset($postData['recipe'])) {

    echo "il manque des informations pour permettre l'édition du formulaire";

    return;
}


$id = $postData['id'];  // id de la recette

$title = $postData['title'];   // titre de la recette

$recipe = $postData['recipe']; //  description de la recette

// Gérer l'upload de l'image
$imagePath = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imagePath = '../uploads/' . basename($imageName); // Chemin d'accès à l'image

    // Déplacer l'image vers le dossier 'uploads'
    move_uploaded_file($imageTmpName, $imagePath);

    // Préparer la requête SQL pour mettre à jour la recette
    $updateRecipeStatement = $pdo->prepare('UPDATE recipes SET title = :title, recipe = :recipe, image_path = :image_path WHERE recipe_id = :id');

    // Lier les valeurs aux paramètres de la requête
    $updateRecipeStatement->execute([
        'title' => $title,
        'recipe' => $recipe,
        'image_path' => $imagePath, // Utilisez le chemin de l'image téléchargée
        'id' => $id,
    ]);
} else {
    // Si aucune nouvelle image n'est téléchargée, conservez l'ancienne image
    $updateRecipeStatement = $pdo->prepare('UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :id');

    // Lier les valeurs aux paramètres de la requête
    $updateRecipeStatement->execute([
        'title' => $title,
        'recipe' => $recipe,
        'id' => $id,
    ]);
}

// Vérifier que les données sont bien mises à jour
$recupRecipStatement = $pdo->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
$recetteUpdatedSuccessfully = $recupRecipStatement->execute(['id' => $id]);
$updatedRecipe = $recupRecipStatement->fetch(PDO::FETCH_ASSOC);


if ($updateRecipeStatement->errorCode() !== '00000') {
    $errorInfo = $updateRecipeStatement->errorInfo();
    if (isset($errorInfo[2])) {
        echo "Erreur : " . $errorInfo[2];
    } else {
        echo "Erreur inconnue";
    }
} else {
    // echo "La requête a été exécutée avec succès.";
}

if ($recetteUpdatedSuccessfully) {
    // Après une non réussie
    $message = "recette mise à jour avec succés !";
    $toastType = "error";

    // Avant la redirection
    $_SESSION['toast'] = array('type' => $toastType, 'message' => $message);

    // Redirection
    header("Location: " . BASE_URL . "index.php");
    exit();
} else {
    // Après une non réussie
    $message = "Oops, recette non mise à jour !";
    $toastType = "error";

    // Redirection
    header("Location:" . BASE_URL . "index.php?toast=" . urlencode($toastType) . urlencode($message));
    exit();
}


?>


