<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResponsableF
 *
 * @author machin
 */
class ResponsableF {
    //put your code here
    private $nomCompte;
    private $mdp;
    private $nom;
    private $prenom;
    private $email;
    
    function __construct($nomCompte, $mdp, $nom, $prenom, $email) {
        $this->nomCompte = $nomCompte;
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
    }

    function getNomCompte() {
        return $this->nomCompte;
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

    function getEmail() {
        return $this->email;
    }

    function setNomCompte($nomCompte) {
        $this->nomCompte = $nomCompte;
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

    function setEmail($email) {
        $this->email = $email;
    }


}
