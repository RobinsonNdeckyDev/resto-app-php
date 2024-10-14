<?php

session_start();
require_once '../db/databaseConnect.php';
require_once '../config/fonctions.php';
require_once '../functions/messsage.php';

// Vérifiez si $pdo est correctement initialisé
if ($pdo === null) {
    die('Erreur : la connexion à la base de données a échoué.');
}

// Validation des données POST
$postData = $_POST;
if (isset($postData['email']) && isset($postData['password'])) {

    $email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
    $password = $postData['password'];

    // Afficher les valeurs pour le débogage
    echo "email: " . htmlspecialchars($email) . "<br>";
    echo "password: " . htmlspecialchars($password) . "<br>";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Il faut un email valide pour soumettre le formulaire.';
    } else {
        try {
            // Utiliser une requête préparée pour éviter les injections SQL
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Récupérer l'utilisateur correspondant à l'email
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Vérifiez si le mot de passe est haché
                if (password_verify($password, $user['password'])) {
                    // Si la vérification du mot de passe est réussie, définir l'utilisateur comme connecté
                    $_SESSION['LOGGED_USER'] = [
                        'email' => $user['email'],
                        'user_id' => $user['user_id'],
                    ];

                    // Après une identification réussie
                    $message = "Bienvenu" . $_SESSION['LOGGED_USER']['email'] ."!";
                    $toastType = "info";
                    // Avant la redirection
                    $_SESSION['toast'] = array('type' => $toastType, 'message' => $message);

                    // Redirection après connexion réussie
                    header("Location:" . BASE_URL . "index.php?toast=success&message=" . urlencode($message));
                    exit();

                } else {
                    $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Le mot de passe est incorrect.';
                }
            } else {
                $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Utilisateur non trouvé.';
            }
        } catch (PDOException $e) {
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Erreur lors de la connexion à la base de données.';
        }
    }

    // Redirection après échec de la connexion
    redirectToUrl('login.php');
}
