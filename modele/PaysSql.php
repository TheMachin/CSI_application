<?php
include("Pays.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaysSql
 *
 * @author machin
 */
class PaysSql {
    
    function getAllPays($pdo){
        $tabPays=array();
        $req = $pdo->prepare("SELECT * FROM pays");
        $req->execute();
        foreach ($req as $row) {
            
            $pays=new Pays($row["NO_PAYS"], $row["NOM_PAYS"]);
            array_push($tabPays, $pays);
        }
        return $tabPays;
    }
    
    function getPaysById($pdo,$id){
        $req = $pdo->prepare("SELECT * FROM pays WHERE NO_PAYS=?");
        $req->bindValue(1,$id);
        $req->execute();
        $row=$req->fetch();
            $pays=new Pays($row["NO_PAYS"], $row["NOM_PAYS"]);
        return $pays;
    }
    
}
