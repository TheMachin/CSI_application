<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Document
 *
 * @author machin
 */
class Document {
    //put your code here
    private $no;
    private $nom;
    private $type;
    
    
    function __construct($no, $nom, $type) {
        $this->no = $no;
        $this->nom = $nom;
        $this->type = $type;
    }

    function getNo() {
        return $this->no;
    }

    function getNom() {
        return $this->nom;
    }

    function getType() {
        return $this->type;
    }

    function setNo($no) {
        $this->no = $no;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setType($type) {
        $this->type = $type;
    }


}
