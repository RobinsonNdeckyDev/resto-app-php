<?php

session_start(); // Démarrez la session si ce n'est pas déjà fait

require_once '../config/fonctions.php';
require_once('../functions/messsage.php');

// Détruire la session
session_unset();
session_destroy();

// Afficher un message de succès de déconnexion et rediriger
showToastWithRedirect('Déconnexion réussie !', 'success', 3000, BASE_URL . 'index.php');

exit(); // Terminer le script ici


