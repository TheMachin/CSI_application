<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dossier
 *
 * @author machin
 */
class Dossier {
    //put your code here
    private $no;
    private $candidat;
    private $gestionnaire;
    private $verification;
    private $tabD;
    private $tabCandidature;
    
    function __construct($no,  Candidat $candidat, $gestionnaire, $verification) {
        $this->no = $no;
        $this->candidat = $candidat;
        $this->gestionnaire = $gestionnaire;
        $this->verification = $verification;
    }
    
    function getTabCandidature() {
        return $this->tabCandidature;
    }

    function setTabCandidature($tabCandidature) {
        $this->tabCandidature = $tabCandidature;
    }

    function getNo() {
        return $this->no;
    }
    function getTabD() {
        return $this->tabD;
    }

    function setTabD($tabD) {
        $this->tabD = $tabD;
    }

        function getCandidat() {
        return $this->candidat;
    }

    function getGestionnaire() {
        return $this->gestionnaire;
    }

    function getVerification() {
        return $this->verification;
    }

    function setNo($no) {
        $this->no = $no;
    }

    function setCandidat(Candidat $candidat) {
        $this->candidat = $candidat;
    }

    function setGestionnaire($gestionnaire) {
        $this->gestionnaire = $gestionnaire;
    }

    function setVerification($verification) {
        $this->verification = $verification;
    }



}
