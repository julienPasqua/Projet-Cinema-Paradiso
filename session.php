<?php
// login.php
session_start();
$page = basename($_SERVER['PHP_SELF']);

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Ici, tu vérifieras l'utilisateur dans la base de données
    // Pour l'exemple, on utilise un utilisateur fictif
    if ($email == "email" && $password == "password") {
        $_SESSION['email'] = $email;  // On démarre la session si les informations sont correctes
        header("Location: films_recents.php");  // Redirection vers la page des films récents
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}*/
function login($id_utilisateur, $nom, $date_creation){
    $_SESSION["id_utilisateur"] = $id_utilisateur;
    $_SESSION["nom"] = $nom;
    $_SESSION["date_creation"] = $date_creation;
}
?>