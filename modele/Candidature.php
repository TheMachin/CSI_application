<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Candidature
 *
 * @author machin
 */
class Candidature {
    //put your code here
    private $no;
    private $lettreMotiv;
    private $dossier;
    private $formation;
    private $verificaion;
    private$date;
    
    function __construct($no, $lettreMotiv,  Dossier $dossier, $verificaion, $date) {
        $this->no = $no;
        $this->lettreMotiv = $lettreMotiv;
        $this->dossier = $dossier;
        $this->verificaion = $verificaion;
        $this->date = $date;
    }

    
    function getNo() {
        return $this->no;
    }

    function getLettreMotiv() {
        return $this->lettreMotiv;
    }

    function getDossier() {
        return $this->dossier;
    }

    function getVerificaion() {
        return $this->verificaion;
    }

    function getDate() {
        return $this->date;
    }

    function setNo($no) {
        $this->no = $no;
    }

    function setLettreMotiv($lettreMotiv) {
        $this->lettreMotiv = $lettreMotiv;
    }

    function setDossier(Dossier $dossier) {
        $this->dossier = $dossier;
    }

    function setVerificaion($verificaion) {
        $this->verificaion = $verificaion;
    }

    function setDate($date) {
        $this->date = $date;
    }


}
