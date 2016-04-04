<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pays
 *
 * @author machin
 */
class Pays {
    //put your code here
    private $id;
    private $nom_pays;
    
    function __construct($id, $nom_pays) {
        $this->id = $id;
        $this->nom_pays = $nom_pays;
    }

    function getId() {
        return $this->id;
    }

    function getNom_pays() {
        return $this->nom_pays;
    }

    function setNom_pays($nom_pays) {
        $this->nom_pays = $nom_pays;
    }



}
