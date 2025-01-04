<?php
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../classes/DB.php';
require_once __DIR__ . '/../classes/Utilisateur.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération sécurisée de l'ID utilisateur
    $id_utilisateur = $_POST['id_utilisateur'] ?? null;

    if ($id_utilisateur) {
        try {
            $conn = DB::getConnection();

            // Vérification du rôle de l'utilisateur
            $stmt = $conn->prepare("SELECT role FROM utilisateur WHERE Id_utilisateur = ?");
            $stmt->execute([(int)$id_utilisateur]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$utilisateur) {
                $error_message = "Utilisateur introuvable.";
            } else {
                // Suppression de l'utilisateur
                $stmt = $conn->prepare("DELETE FROM utilisateur WHERE Id_utilisateur = ?");
                $stmt->execute([(int)$id_utilisateur]);

                // Redirection avec un message de succès
                header("Location: admin.php?success=Utilisateur supprimé");
                exit();
            }
        } catch (Exception $e) {
            $error_message = "Erreur lors de la suppression de l'utilisateur : " . htmlspecialchars($e->getMessage());
        }
    } else {
        $error_message = "ID utilisateur manquant.";
    }
} else {
    $error_message = "Méthode non autorisée.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression utilisateur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Suppression d'utilisateur</h1>
        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger">
                <?= $error_message ?>
            </div>
        <?php endif; ?>
        <a href="admin.php" class="btn-primary">Retour à la gestion des utilisateurs</a>
    </div>
</body>
</html>
