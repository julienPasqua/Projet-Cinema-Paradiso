<?php
// Inclure les fichiers nécessaires
require_once __DIR__ . '/../classes/DB.php'; // Inclure la classe DB
require_once __DIR__ . '/../classes/Utilisateur.php'; // Inclure la classe Utilisateur

// Activer les erreurs pour le débogage (désactiver en production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialiser les messages
$successMessage = "";
$errorMessage = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Générer automatiquement la date de création
    $date_creation = date('Y-m-d H:i:s');

    // Valider les champs
    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        $errorMessage = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Veuillez entrer un email valide.";
    } else {
        try {
            // Créer un nouvel utilisateur
            $utilisateur = new Utilisateur($nom, $prenom, $email, $password, $date_creation);

            // Sauvegarder dans la base de données
            $utilisateur->save($nom, $prenom, $email, $password, $date_creation);

            // Redirection après succès
            header("Location: http://127.0.0.1:8888/leloupcinoche/login.php");
            
            exit();
        } catch (Exception $e) {
            $errorMessage = "Une erreur est survenue : " . htmlspecialchars($e->getMessage());
        }
    }
}

// Afficher un message d'erreur en cas de problème
if ($errorMessage) {
    echo "<div class='alert alert-danger'>$errorMessage</div>";
}
?>
