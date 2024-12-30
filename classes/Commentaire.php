<?php

class Commentaire{
    private $id_commentaire;
    private $commentaire;
    private $date_commentaire;
    private $note;
    private $id_utilisateur;
    private $id_media;


    public function __construct($id_commentaire, $commentaire, $date_commentaire, $note, $id_utilisateur, $id_media)
    {
        $this->id_commentaire = $id_commentaire;
        $this->commentaire = $commentaire;
        $this->date_commentaire = $date_commentaire;
        $this->note = $note;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_media = $id_media;
        
    }





    /**
     * Get the value of id_commentaire
     */ 
    public function getId_commentaire()
    {
        return $this->id_commentaire;
    }

    /**
     * Set the value of id_commentaire
     *
     * @return  self
     */ 
    public function setId_commentaire($id_commentaire)
    {
        $this->id_commentaire = $id_commentaire;

        return $this;
    }

    /**
     * Get the value of commentaire
     */ 
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set the value of commentaire
     *
     * @return  self
     */ 
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get the value of date_commentaire
     */ 
    public function getDate_commentaire()
    {
        return $this->date_commentaire;
    }

    /**
     * Set the value of date_commentaire
     *
     * @return  self
     */ 
    public function setDate_commentaire($date_commentaire)
    {
        $this->date_commentaire = $date_commentaire;

        return $this;
    }

    /**
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
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
     * Get the value of id_media
     */ 
    public function getId_media()
    {
        return $this->id_media;
    }

    /**
     * Set the value of id_media
     *
     * @return  self
     */ 
    public function setId_media($id_media)
    {
        $this->id_media = $id_media;

        return $this;
    }
}
