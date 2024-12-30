<?php

class Appartient{

    private $id;
    private $id_categorie;
    private $id_media;


    public function __construct($id, $id_categorie, $id_media)
    {
        $this->id = $id;
        $this->id_categorie = $id_categorie;
        $this->id_media = $id_media;
    }



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id_categorie
     */ 
    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of id_categorie
     *
     * @return  self
     */ 
    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

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