<?php
// logout.php
session_start();  // Démarre la session pour pouvoir la manipuler

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil ou de connexion
header("Location: login.php");
exit();

?>
