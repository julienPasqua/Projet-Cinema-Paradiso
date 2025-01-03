<?php

class Utilisateur{

    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $mot_de_passe;
    private $role;
    private $date_creation;
    private $actif ;

    public function __construct($nom, $prenom, $email, $mot_de_passe, $role = 'user', $date_creation = null , $actif = 1)
    {
     $this->nom = $nom;
     $this->prenom = $prenom;
     $this->email = $email;
     $this->mot_de_passe = $mot_de_passe;
     $this->role = $role;
     $this->date_creation = $date_creation ?: date("Y-m-d H:i:s"); // Date actuelle si non fournie
     $this->actif = $actif;
    }
    public static function login($email, $mot_de_passe) {
        $requete = DB::getConnection()->prepare("SELECT * FROM utilisateur WHERE email = ?");
        $requete->execute([$email]);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
    
        if (!$utilisateur) {
            $_SESSION['error_message'] = "Email ou mot de passe incorrect.";
            return false;
        }
    
        if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // Ajouter le rôle dans l'objet utilisateur
            $user = new Utilisateur(
                $utilisateur['nom'],
                $utilisateur['prenom'],
                $utilisateur['email'],
                $utilisateur['mot_de_passe'],
                $utilisateur['role'], // Inclure le rôle
                $utilisateur['date_creation'],
                $utilisateur['actif']
            );
            $user->id_utilisateur = $utilisateur['id_utilisateur'];
            return $user;
        } else {
            $_SESSION['error_message'] = "Email ou mot de passe incorrect.";
            return false;
        }
    }
    
      // Méthode pour récupérer tous les utilisateurs
      public static function findAll() {
        try {
            $conn = DB::getConnection();
            $stmt = $conn->query("SELECT * FROM utilisateur");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
        }
    }
    
      // Méthode pour supprimer un utilisateur
      public static function delete($id_utilisateur) {
        $requete = DB::getConnection()->prepare("DELETE FROM utilisateur WHERE id_utilisateur = ?");
        $requete->execute([$id_utilisateur]);
    }

  // Méthode pour enregistrer ou mettre à jour un utilisateur
public function save($nom, $prenom, $email, $mot_de_passe, $date_creation = null , $actif = true) {
    // Si l'utilisateur a un ID, on fait une mise à jour
    if ($this->id_utilisateur) {
        $query = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, mot_de_passe = :mot_de_passe WHERE id_utilisateur = :id_utilisateur";
        $stmt = DB::getConnection()->prepare($query);
        $stmt->bindParam(':id_utilisateur', $this->id_utilisateur);
    } else {
        // Si l'utilisateur n'a pas d'ID, on insère un nouvel utilisateur
        $query = "INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, date_creation, actif) VALUES (:nom, :prenom, :email, :mot_de_passe, :date_creation, :actif)";
        $stmt = DB::getConnection()->prepare($query);
        $stmt->bindParam(':date_creation', $this->date_creation);
        $stmt->bindParam(':actif', $actif, PDO::PARAM_BOOL);
       
    }

    // On lie les autres paramètres (nom, prenom, email, mot_de_passe)
     // Hachage du mot de passe
     $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

     // On lie les paramètres
     $stmt->bindParam(':nom', $nom);
     $stmt->bindParam(':prenom', $prenom);
     $stmt->bindParam(':email', $email);
     $stmt->bindParam(':mot_de_passe', $hashed_password);
   // Assurez-vous que le mot de passe est haché

    // Exécution de la requête
    $stmt->execute();
}


    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of mot_de_passe
     */ 
    public function getMot_de_passe()
    {
        return $this->mot_de_passe;
    }

    /**
     * Set the value of mot_de_passe
     *
     * @return  self
     */ 
    public function setMot_de_passe($mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    /**
     * Get the value of date_creation
     */ 
    public function getDate_creation()
    {
        return $this->date_creation;
    }

    /**
     * Set the value of date_creation
     *
     * @return  self
     */ 
    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    /**
     * Get the value of actif
     */ 
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set the value of actif
     *
     * @return  self
     */ 
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
