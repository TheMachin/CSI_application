<?php
include("Universite.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UniversiteSql
 *
 * @author machin
 */
class UniversiteSql {
    //put your code here
    function getAll($pdo)
    {
        $tab=array();
        $req = $pdo->prepare("SELECT * FROM UNIVERSITE");
        $req->execute();
        foreach ($req as $row) {
            $univ=new Universite($row["NO_UNIV"], $row["NOM_UNIV"], $row["VILLE"]);
            array_push($tab, $univ);
        }
        return $tab;
    }
    
    function getById($pdo,$id)
    {
        $req = $pdo->prepare("SELECT * FROM UNIVERSITE WHERE NO_UNIV=?");
        $req->bindValue(1,$id);
        $req->execute();
        $row=$req->fetch();
        $univ=new Universite($row["NO_UNIV"], $row["NOM_UNIV"], $row["VILLE"]);
        return $univ;
    }
}
