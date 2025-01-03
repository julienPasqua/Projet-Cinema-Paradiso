<?php
session_start();

// Vérifiez si l'utilisateur est connecté et a le rôle administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Inclure les fichiers nécessaires
require_once '../autoload.php';
require_once '../classes/DB.php';
require_once '../classes/Utilisateur.php';

// Récupérer l'ID utilisateur depuis l'URL et le forcer à être un entier
$id_utilisateur = isset($_GET['id']) ? (int) $_GET['id'] : 0; // Forcer l'ID en tant qu'entier

if ($id_utilisateur === 0) {
    die("ID utilisateur invalide.");
}

// Connexion à la base de données et récupération des informations de l'utilisateur
$conn = DB::getConnection();
$stmt = $conn->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
$stmt->execute([$id_utilisateur]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    die("Utilisateur introuvable.");
}

// Traiter la soumission du formulaire pour modifier l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? $utilisateur['nom'];
    $prenom = $_POST['prenom'] ?? $utilisateur['prenom'];
    $email = $_POST['email'] ?? $utilisateur['email'];
    $role = $_POST['role'] ?? $utilisateur['role'];

    // Mise à jour de l'utilisateur dans la base de données
    try {
        // Forcer l'ID utilisateur à être un entier lors de la mise à jour
        $stmt = $conn->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, role = ? WHERE id_utilisateur = ?");
        $stmt->execute([$nom, $prenom, $email, $role, $id_utilisateur]); // Forcer l'ID en tant qu'entier

        header("Location: admin.php?success=Utilisateur modifié");
        exit();
    } catch (Exception $e) {
        die("Erreur lors de la modification de l'utilisateur : " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <style>
        :root {
            --primary-color: #0f056b;
            --secondary-color: #ff7f50;
            --tertiary-color: #f5efef;
            --text-color: white;
            --border-color: #0f056b;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--primary-color);
            color: var(--text-color);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            padding: 20px;
        }

        h1 {
            font-size: 40px;
            font-weight: bold;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            background-size: 200% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
            animation: deplacementDegrade 10s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes deplacementDegrade {
            0% {
                background-position: -200% 0;
            }
            50% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        form {
            background-color: var(--tertiary-color);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .form-group input {
            width: 95%;
            padding: 12px;
            font-size: 14px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background-color: #fff;
            color: #333;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--secondary-color);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: var(--secondary-color);
            color: var(--text-color);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        button:hover {
            background-color: var(--primary-color);
            border-color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <h1>Modifier un utilisateur</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur['prenom']) ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required>
        </div>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
