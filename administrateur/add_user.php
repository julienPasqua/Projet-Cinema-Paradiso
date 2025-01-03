<?php
require_once __DIR__ . '/../classes/DB.php';
require_once __DIR__ . '/../classes/Utilisateur.php';
require_once '../autoload.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $date_creation = date('Y-m-d H:i:s');

    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        die("Tous les champs sont obligatoires.");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    } else {
        try {
            $utilisateur = new Utilisateur($nom, $prenom, $email, $password, $date_creation);
            $utilisateur->save($nom, $prenom, $email, $password, $date_creation);

            header("Location: admin.php?success=Utilisateur ajouté");
            exit();
        } catch (Exception $e) {
            die("Erreur : " . htmlspecialchars($e->getMessage()));
        }
    }
}
?>
