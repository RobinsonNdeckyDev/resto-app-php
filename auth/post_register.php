<?php

session_start();

// Inclusion des fichiers nécessaires
require_once '../db/mysql.php';  // Connexion à la base de données
require_once '../db/databaseConnect.php';  // Fichier de connexion PDO
require_once '../functions/messsage.php';  // Fichier pour afficher les messages
require_once '../config/variables.php';

$uploadDir = '../uploads/'; // Définir le répertoire où les fichiers seront téléchargés

// Vérification si la requête est POST (l'inscription se fait par une requête POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération et nettoyage des données du formulaire
    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $age = trim($_POST['age']);

    // Vérification si l'email est déjà utilisé dans la base de données
    $checkEmailStmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $checkEmailStmt->execute(['email' => $email]);

    if ($checkEmailStmt->rowCount() > 0) {
        // Si l'email est déjà utilisé, afficher un message d'erreur
        showToastWithRedirect('Cet email est déjà utilisé !', 'error', 3000);

        // Redirection si email existe déja
        header("Location:" . BASE_URL . "index.php?toast=error");
        exit();
    } else {
        // Gestion du téléchargement de l'image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Chemin temporaire et nom de l'image
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageName = $_FILES['image']['name'];
            $imagePath = $uploadDir . basename($imageName); // Chemin où l'image sera stockée

            // Vérifier si le dossier 'uploads' existe, sinon le créer
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Crée le dossier avec les permissions 0777
            }

            // Déplacer le fichier téléchargé dans le répertoire 'uploads'
            if (!move_uploaded_file($imageTmpPath, $imagePath)) {
                echo "Erreur lors du déplacement de l'image.";
                return;
            } else {
                echo "Image téléchargée avec succès dans : " . $imagePath;
            }
        } else {
            // Gestion des erreurs de téléchargement de l'image
            echo "Erreur de téléchargement : " . $_FILES['image']['error'];
            return;
        }

        // Hachage du mot de passe avant de l'enregistrer dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion des informations de l'utilisateur dans la base de données
        $insertUserStmt = $pdo->prepare('
            INSERT INTO users (prenom, nom, email, password, age, image_path) 
            VALUES (:prenom, :nom, :email, :password, :age, :image_path)
        ');
        $insertUserStmt->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'password' => $hashedPassword,
            'age' => $age,
            'image_path' => $imagePath,  // Insérer le chemin de l'image dans la base de données
        ]);

        
        // Après une connexion réussie
        $message = "Inscription réussie avec succés !";

        // Redirection après connexion réussie
        header("Location:" . BASE_URL . "index.php?toast=success&message=" . urlencode($message));
        exit();
    }
} else {
    // Message d'erreur si la méthode HTTP n'est pas POST
    showToastWithRedirect('Oops ! Méthode non autorisée.', 'error', 3000);

    // Redirection après connexion réussie
    redirectToUrl('index.php');
    exit();
}
