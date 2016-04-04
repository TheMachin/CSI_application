<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of candidat
 *
 * @author machin
 */
class Candidat {
    //put your code here
    private $nom_candidat;
    private $pays;
    private $mdp;
    private $nom;
    private $prenom;
    private $date_nais;
    private $email;
    private $telephone;
    
    function __construct($nom_candidat,  Pays $pays, $mdp, $nom, $prenom, $date_nais, $email, $telephone) {
        $this->nom_candidat = $nom_candidat;
        $this->pays = $pays;
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_nais = $date_nais;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    function getNom_candidat() {
        return $this->nom_candidat;
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

    function getDate_nais() {
        return $this->date_nais;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function setNom_candidat($nom_candidat) {
        $this->nom_candidat = $nom_candidat;
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

    function setDate_nais($date_nais) {
        $this->date_nais = $date_nais;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }


    
}
