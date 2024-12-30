<?php

class Media{

    private $id_media;
    private $titre;
    private $description;
    private $date_debut;
    private $image_url;
    private $id_media_type;



    public function __construct($id_media, $titre, $description, $date_debut, $image_url, $id_media_type,)
    {
        $this->id_media = $id_media;
        $this->titre = $titre;
        $this->description = $description;
        $this->date_debut = $date_debut;
        $this->image_url = $image_url;
        $this->id_media_type = $id_media_type;
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

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of date_debut
     */ 
    public function getDate_debut()
    {
        return $this->date_debut;
    }

    /**
     * Set the value of date_debut
     *
     * @return  self
     */ 
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    /**
     * Get the value of image_url
     */ 
    public function getImage_url()
    {
        return $this->image_url;
    }

    /**
     * Set the value of image_url
     *
     * @return  self
     */ 
    public function setImage_url($image_url)
    {
        $this->image_url = $image_url;

        return $this;
    }

    /**
     * Get the value of id_media_type
     */ 
    public function getId_media_type()
    {
        return $this->id_media_type;
    }

    /**
     * Set the value of id_media_type
     *
     * @return  self
     */ 
    public function setId_media_type($id_media_type)
    {
        $this->id_media_type = $id_media_type;

        return $this;
    }
}