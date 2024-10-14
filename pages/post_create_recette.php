<?php

session_start();
$pdo = require_once '../db/databaseConnect.php';
require_once '../config/variables.php';

$imagePath = __DIR__ . '/../uploads/' . basename($imageName);

$postData = $_POST;

// Vérification des champs de notre formulaire d'ajout
if (
    empty($postData['title'])
    || empty($postData['recipe'])
    || trim(strip_tags($postData['title'])) === ''
    || trim(strip_tags($postData['recipe'])) === ''
) {
    echo $postData['title'];

    echo "il faut un titre et une descritpion pour envoyer le formulaire";

    return;
}

// Recup. des valeurs de champs
$title = $_POST['title'];
$recipe = $_POST['recipe'];
$imagePath = '';


// Gestion du téléchargement de l'image
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Vérifiez si le dossier uploads existe, sinon créez-le
    if (!file_exists('../uploads')) {
        mkdir('../uploads', 0777, true);
    }

    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $imagePath = '../uploads/' . basename($imageName); // Chemin où l'image sera stockée

    // Déplacer le fichier téléchargé dans le répertoire 'uploads'
    if (!move_uploaded_file($imageTmpPath, $imagePath)) {
        echo "Erreur lors du déplacement de l'image.";
        return;
    }
} else {
    echo "Erreur de téléchargement : " . $_FILES['image']['error'];
    return;
}

// Faire une insertion dans la base de données
$requete = $pdo->prepare("INSERT INTO recipes(title, recipe, author, image_path, is_enabled) VALUES(:title, :recipe, :author, :image_path, :is_enabled)");

// Exécution de la requête
$requete->execute([
    'title' => $title,
    'recipe' => $recipe,
    'image_path' => $imagePath, // Ajoutez le chemin de l'image ici
    'author' => $_SESSION['LOGGED_USER']['email'],
    'is_enabled' => 1 // Ne pas le répéter
]);

/// Après ajout réussie
$message = "Recette ajouté avec succés !";
$toastType = "success"; // or "error", "info", "warning"

// Redirection après ajout réussie
header("Location:" . BASE_URL . "index.php?toast=" . urlencode($toastType) . "&message=" . urlencode($message));
exit();

