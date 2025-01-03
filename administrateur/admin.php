<?php
session_start();

// Vérifiez si l'utilisateur est connecté et s'il a le rôle administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Inclure les fichiers nécessaires
require_once '../autoload.php';
require_once '../classes/DB.php';
require_once '../classes/Utilisateur.php';

try {
    // Récupération des utilisateurs
    $utilisateurs = Utilisateur::findAll();
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0f056b;
            --secondary-color: #ff7f50;
            --tertiary-color: #f5efef;
            --text-color: white;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background-color: var(--primary-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 120vh;
            flex-direction: column;
            padding-right: 10%; /* Décalage général du contenu à droite */
        }

        .container {
            background-color: white;
            color: black;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            text-align: center;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: var(--primary-color);
            color: var(--text-color);
        }

        table td {
            background-color: var(--tertiary-color);
        }

        /* Style commun pour les boutons */
        button {
            border: 2px solid #0f056b; /* Bordure de couleur #0f056b */
            background-color: #ff7f50; /* Couleur de fond intérieure */
            color: white; /* Couleur du texte en blanc */
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease; /* Animation lors du survol */
            margin-right: 10px; /* Espacement entre les boutons */
        }

        /* Effet au survol des boutons */
        button:hover {
            background-color: #0f056b; /* Changement de fond à la couleur de la bordure */
            border-color: #ff7f50; /* Changement de la bordure à la couleur du fond */
        }

        /* Boutons spécifiques : Modifier et Supprimer */
        button.modify {
            background-color: #ff7f50; /* Fond spécifique pour le bouton Modifier */
            color: white; /* Texte en blanc */
        }

        button.modify:hover {
            background-color: #0f056b; /* Fond au survol pour le bouton Modifier */
            border-color: #ff7f50; /* Bordure au survol */
        }

        button.delete {
            background-color: red; /* Fond spécifique pour le bouton Supprimer */
            color: white; /* Texte en blanc */
        }

        button.delete:hover {
            background-color: #ff7f50; /* Fond au survol pour le bouton Supprimer */
            border-color: red; /* Bordure au survol */
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: var(--secondary-color);
            color: var(--text-color);
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: var(--primary-color);
        }

        .add-user-form {
            margin-top: 20px;
            padding: 30px;
            background-color: var(--tertiary-color);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .add-user-form h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .add-user-form button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .add-user-form button:hover {
            background-color: var(--primary-color);
        }

    </style>
</head>
<body>
    <button class="logout-btn" onclick="window.location.href='../logout.php'">Déconnexion</button>

    <div class="container">
        <h1>Gestion des utilisateurs</h1>

        <!-- Affichage des utilisateurs -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actif</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Vérifiez si $utilisateurs contient des données avant de les afficher
            if (!empty($utilisateurs)) {
                foreach ($utilisateurs as $utilisateur) {
                    // Utilisation de '??' pour vérifier l'existence de chaque valeur dans l'élément
                    $id_utilisateur = (int) $utilisateur['Id_utilisateur'] ?? 'Non défini'; // Correction ici
                    $nom = htmlspecialchars($utilisateur['nom'] ?? 'Non défini');
                    $prenom = htmlspecialchars($utilisateur['prenom'] ?? 'Non défini');
                    $email = htmlspecialchars($utilisateur['email'] ?? 'Non défini');
                    $role = htmlspecialchars($utilisateur['role'] ?? 'Non défini');
                    $actif = isset($utilisateur['actif']) && $utilisateur['actif'] ? 'Oui' : 'Non';
                    $date_creation = htmlspecialchars($utilisateur['date_creation'] ?? 'Non défini');

                    echo "<tr>
                        <td>{$id_utilisateur}</td>
                        <td>{$nom}</td>
                        <td>{$prenom}</td>
                        <td>{$email}</td>
                        <td>{$role}</td>
                        <td>{$actif}</td>
                        <td>{$date_creation}</td>
                        <td>
                            <a href='edit_user.php?id={$id_utilisateur}'>
                                <button class='modify'>Modifier</button>
                            </a>
                            <form action='delete_user.php' method='POST' style='display: inline;'>
                                <input type='hidden' name='id_utilisateur' value='{$id_utilisateur}'>
                                <button type='submit' class='delete'>Supprimer</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                // Si aucun utilisateur n'est trouvé
                echo "<tr><td colspan='8'>Aucun utilisateur trouvé</td></tr>";
            }
            ?>
            </tbody>
        </table>

        <!-- Formulaire pour ajouter un utilisateur -->
        <div class="add-user-form">
            <h2>Ajouter un utilisateur</h2>
            <form action="add_user.php" method="POST">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Rôle</label>
                    <select id="role" name="role" required>
                        <option value="user">Utilisateur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <button type="submit" class="add-user">Ajouter</button>
            </form>
        </div>
    </div>
</body>
</html>
