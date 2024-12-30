<?php
require_once "../autoload.php";

if ($_GET['action'] == 'new') {
    // Ajouter un nouvel utilisateur
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_BCRYPT); // Hachage du mot de passe
    $utilisateur = new Utilisateur(null, $nom, $prenom, $email, $mot_de_passe);
    $utilisateur->save($nom, $prenom, $email, $password, $date_de_creation, $actif); // Enregistrer l'utilisateur
}

if ($_GET['action'] == 'update') {
    // Mettre à jour un utilisateur existant
    if (isset($_POST["id_utilisateur"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"])) {
        $id_utilisateur = $_POST["id_utilisateur"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $mot_de_passe = isset($_POST["mot_de_passe"]) ? password_hash($_POST["mot_de_passe"], PASSWORD_BCRYPT) : null; // Si mot de passe fourni, on le hache

        $utilisateur = new Utilisateur($id_utilisateur, $nom, $prenom, $email, $mot_de_passe);
        $utilisateur->save($nom, $prenom, $email, $password, $date_de_creation, $actif); // Sauvegarder la mise à jour
    }
}

if ($_GET['action'] == 'delete') {
    // Supprimer un utilisateur
    if (isset($_GET['id_utilisateur'])) {
        Utilisateur::delete($_GET['id_utilisateur']);
    }
}

// Rediriger vers la page des utilisateurs après l'action
header("Location: /utilisateurliste.php");
?>
