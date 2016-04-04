<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Universite
 *
 * @author machin
 */
class Universite {
    //put your code here
    private $no;
    private $nom_univ;
    private $ville;
    
    function __construct($no, $nom_univ, $ville) {
        $this->no = $no;
        $this->nom_univ = $nom_univ;
        $this->ville = $ville;
    }
    
    function getNo() {
        return $this->no;
    }

    function getNom_univ() {
        return $this->nom_univ;
    }

    function getVille() {
        return $this->ville;
    }

    function setNo($no) {
        $this->no = $no;
    }

    function setNom_univ($nom_univ) {
        $this->nom_univ = $nom_univ;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }



}
