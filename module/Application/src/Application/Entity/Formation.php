<?php

namespace Application\Entity;

class Formation {
    protected $id;
    protected $nom;
    protected $prix;
    /**
     * Association avec le formateur
     * @var Formateur 
     */
    private $formateur;
    /**
     * Association avec les stagiaires
     * @var array 
     */
    private $stagiaires = array();
    
    public function __construct($nom = "", $prix = 0) {
        $this->nom = $nom;
        $this->prix = $prix;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    
        public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }
    
    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }

    
    public function getFormateur() {
        return $this->formateur;
    }

    public function setFormateur(Formateur $formateur) {
        $this->formateur = $formateur;
        return $this;
    }

    public function addStagiaire(Personne $stagiaire)
    {
        $this->stagiaires[] = $stagiaire;
        return $this;
    }
    
    public function getStagiaires() {
        return $this->stagiaires;
    }


}
