<?php
require_once '../autoload.php';
require_once '../classes/DB.php';
require_once '../classes/Utilisateur.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez si le paramètre 'Id_utilisateur' est bien reçu
    $Id_utilisateur = $_POST['Id_utilisateur'] ?? null;
    
    // Debugging : afficher la valeur de l'ID
    var_dump($Id_utilisateur); // Ajoutez cette ligne pour voir la valeur de l'ID

    if ($Id_utilisateur) {
        try {
            $conn = DB::getConnection();

            $stmt = $conn->prepare("DELETE FROM utilisateur WHERE Id_utilisateur = ?");
            $stmt->execute([$Id_utilisateur]);

            // Redirection vers admin.php après suppression
            header("Location: admin.php?success=Utilisateur supprimé");
            exit();
        } catch (Exception $e) {
            die("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }
    } else {
        die("ID utilisateur manquant.");
    }
}

?>
