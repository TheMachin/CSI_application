<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formation
 *
 * @author machin
 */
class Formation {
    //put your code here
    private $no;
    private $responsable;
    private $universite;
    private $nomFormation;
    private $domaine;
    private $niveau;
    private $dateLimite;
    private $nbrePlaceLimite;
    
    function __construct($no,  ResponsableF $responsable,  Universite $universite, $nomFormation, $domaine, $niveau, $dateLimite, $nbrePlaceLimite) {
        $this->no = $no;
        $this->responsable = $responsable;
        $this->universite = $universite;
        $this->nomFormation = $nomFormation;
        $this->domaine = $domaine;
        $this->niveau = $niveau;
        $this->dateLimite = $dateLimite;
        $this->nbrePlaceLimite = $nbrePlaceLimite;
    }

    function getNo() {
        return $this->no;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function getUniversite() {
        return $this->universite;
    }

    function getNomFormation() {
        return $this->nomFormation;
    }

    function getDomaine() {
        return $this->domaine;
    }

    function getNiveau() {
        return $this->niveau;
    }

    function getDateLimite() {
        return $this->dateLimite;
    }

    function getNbrePlaceLimite() {
        return $this->nbrePlaceLimite;
    }

    function setNo($no) {
        $this->no = $no;
    }

    function setResponsable(ResponsableF $responsable) {
        $this->responsable = $responsable;
    }

    function setUniversite(Universite $universite) {
        $this->universite = $universite;
    }

    function setNomFormation($nomFormation) {
        $this->nomFormation = $nomFormation;
    }

    function setDomaine($domaine) {
        $this->domaine = $domaine;
    }

    function setNiveau($niveau) {
        $this->niveau = $niveau;
    }

    function setDateLimite($dateLimite) {
        $this->dateLimite = $dateLimite;
    }

    function setNbrePlaceLimite($nbrePlaceLimite) {
        $this->nbrePlaceLimite = $nbrePlaceLimite;
    }


}
