<?php
include_once("session.php");
require_once("autoload.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["pseudo"]) && !empty($_POST["password"])) {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"]; // Ajout du prénom dans le formulaire
        $email = $_POST["email"];
        $pseudo = $_POST["pseudo"]; // Vous pouvez l'ajouter si vous souhaitez le stocker
        $password = $_POST["password"];
        $date_de_creation = date('Y-m-d H:i:s'); // Ajout de la date de création
        $actif = true; // Utilisateur actif par défaut

        try {
            // Créez un nouvel objet Utilisateur et appelez la méthode save()
            $utilisateur = new Utilisateur($nom, $prenom, $email, $password, $date_de_creation, $actif); // Créez un objet utilisateur
            $utilisateur->save($nom, $prenom, $email, $password, $date_de_creation, $actif); // Passer tous les paramètres nécessaires
            echo "<div class='alert alert-success mt-3'>Compte créé !</div>";
            header("Location: login.php");
            exit();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger mt-3'>Erreur lors de la création du compte. Veuillez réessayer. ".$e->getMessage()."</div>";
        }
    } else {
        echo "<div class='alert alert-warning mt-3'>Veuillez remplir tous les champs avant de soumettre le formulaire.</div>";
    }
}
?>







<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Définition des couleurs, déjà définies dans ton CSS global */
        :root {
            --primary-color: #f5efef;
            --secondary-color: #97979d;
            --tertiary-color: #f5efef;
            --main-button-color: #ff7f50; /* Couleur pour les boutons */
            --main-button-hover: #0f056b; /* Couleur au survol des boutons */
        }

        /* Corps de la page */
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background-color: var(--primary-color);
            display: flex;
            justify-content: center; /* Centre horizontalement */
            align-items: center;     /* Centre verticalement */
            height: 100vh;           /* Utilise toute la hauteur de la page */
            background-color: var(--secondary-color); /* Couleur de fond */
        }

        /* Conteneur du formulaire */
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* Limite la largeur du formulaire */
            text-align: center; /* Centre le texte à l'intérieur */
        }

        /* Style du titre */
        h1 {
            font-size: 40px;
            font-weight: bold;
            background: linear-gradient(90deg, #0f056b, #ff7f50);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
            animation: deplacementDegrade 10s linear infinite;
            padding: 30px 50px;
            margin-bottom: 20px;
        }

        /* Animation du dégradé */
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

        /* Style des champs du formulaire */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 2px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Bouton de soumission */
        button {
            background-color: var(--main-button-color);
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: var(--main-button-hover);
        }

        /* Lien vers la page de connexion */
        p {
            margin-top: 20px;
            font-size: 14px;
        }

        p a {
            color: var(--main-button-color);
            text-decoration: none;
        }
        
        p a:hover {
            text-decoration: underline;
        }

        /* Styles pour les alertes */
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #28a745;
            color: white;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Conteneur du formulaire -->
    <div class="container">
        <h1>Inscription</h1>

        <!-- Formulaire -->
        <form action="./Fonctions//fCreateUser.php" method="POST">

            <!-- Alertes -->
            <div class="alert alert-success" id="success-message" style="display: none;">
                Compte créé avec succès !
            </div>
            <div class="alert alert-danger" id="error-message" style="display: none;">
                Erreur lors de l'inscription. Veuillez réessayer.
            </div>

            <!-- Nom -->
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
            </div>

            <!-- Prénom -->
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>
            </div>

            <!-- Mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit">Créer mon compte</button>
        </form>

        <!-- Lien vers la page de connexion -->
        <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
    </div>

    <script>
        // Exemple de gestion d'affichage d'alertes
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        // Affiche un message de succès
        function showSuccess() {
            successMessage.style.display = 'block';
            errorMessage.style.display = 'none';
        }

        // Affiche un message d'erreur
        function showError() {
            errorMessage.style.display = 'block';
            successMessage.style.display = 'none';
        }

        // Pour simulation, on peut appeler showSuccess() ou showError() selon le résultat du traitement
        // showSuccess(); // Décommentez pour afficher le succès
        // showError();  // Décommentez pour afficher l'erreur
    </script>

</body>
</html>

