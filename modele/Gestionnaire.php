<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gestionnaire
 *
 * @author machin
 */
class Gestionnaire {
    //put your code here
    private $nomCompte;
    private $pays;
    private $mdp;
    private $nom;
    private $prenom;
    
    function __construct($nomCompte,  Pays $pays, $mdp, $nom, $prenom) {
        $this->nomCompte = $nomCompte;
        $this->pays = $pays;
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
    
    function getNomCompte() {
        return $this->nomCompte;
    }

    function getPays() {
        return $this->pays;
    }

    function getMdp() {
        return $this->mdp;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function setNomCompte($nomCompte) {
        $this->nomCompte = $nomCompte;
    }

    function setPays(Pays $pays) {
        $this->pays = $pays;
    }

    function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }



}
