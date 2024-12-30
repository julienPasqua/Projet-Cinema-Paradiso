<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

  include_once("session.php");
  require_once("autoload.php");

require_once './classes/DB.php';




/*/ Test de connexion pour déboguer
$email = 'ruliane007@orange.fr';
$password = 'm';  // Le mot de passe en clair
$user = Utilisateur::login($email, $password);*/

// Vérification si l'utilisateur est connecté


if (isset($_SESSION['email'])) {
  echo "<div style='background-color: #ff7f50; color: white; padding: 15px; border-radius: 5px; text-align: center; margin-bottom: 20px;'>
          <strong>✔ Utilisateur connecté !</strong>
        </div>";
} else {
  echo "<div style='background-color: #0f056b; color: white; padding: 15px; border-radius: 5px; text-align: center; margin-bottom: 20px;'>
          <strong>⚠ Veuillez vous connecter.</strong>
        </div>";
}

  $message = '';
  $page = basename($_SERVER['PHP_SELF']);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $message = '';

    if (!empty($email) && !empty($password)) {
        try {
            $user = Utilisateur::login($email, $password);

            if ($user) {
            
                $_SESSION["nom"] = $user->getNom();
                $_SESSION["email"] = $user->getEmail();
                $_SESSION["date_creation"] = $user->getDate_creation();
                $_SESSION["actif"] = $user->getActif();
              
                header("Location: index.php");
                exit();
            } else {
                $message = "Email ou mot de passe incorrect.";
            }
        } catch (Exception $e) {
            $message = "Une erreur est survenue : " . htmlspecialchars($e->getMessage());
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #f5efef;
            --secondary-color: #97979d;
            --tertiary-color: #f5efef;
            --main-button-color: #ff7f50;
            --main-button-hover: #0f056b;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background-color: var(--secondary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column; /* Ajout pour placer le bouton et le formulaire verticalement */
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .header-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            color: var(--main-button-color);
            border: 2px solid var(--main-button-color);
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .header-btn:hover {
            background-color: var(--main-button-color);
            color: white;
        }

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

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
        }

        p {
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <!-- Bouton "Cinema Paradiso" -->
    <a href="index.php" class="header-btn">Cinema Paradiso</a>

    <div class="container">
        <h1>Connexion</h1>

        <!-- Affichage des erreurs -->
        <?php if ($message): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire -->
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>

