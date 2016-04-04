<?php
include("Formation.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormationSql
 *
 * @author machin
 */
class FormationSql {
    //put your code here
    function getAll($pdo)
    {
        $tab=array();
        $req = $pdo->prepare("SELECT * FROM FORMATION");
        $req->execute();
        foreach ($req as $row) {
            $responsableql=new ResponsableFSql();
            $univSql=new UniversiteSql();
            $formation=new Formation($row["NO_FORMATION"], $responsableql->getByNomUser($pdo, $row["NOM_COMPTE_RESPFOM"]), $univSql->getById($pdo, $row["NO_UNIV"]), $row["NOM_FORMATION"], $row["DOMAINE"], $row["NIVEAU"], $row["DATE_LIMITE"], $row["NBRE_PLACE_LIMITE"]);
            array_push($tab, $formation);
        }
        return $tab;
    }
    
    function getById($pdo,$id)
    {
        $req = $pdo->prepare("SELECT * FROM FORMATION WHERE NO_FORMATION=?");
        $req->bindValue(1,$id);
        $req->execute();
        $row=$req->fetch();
        $responsableql=new ResponsableFSql();
        $univSql=new UniversiteSql();
        $formation=new Formation($row["NO_FORMATION"], $responsableql->getByNomUser($pdo, $row["NOM_COMPTE_RESPFOM"]), $univSql->getById($pdo, $row["NO_UNIV"]), $row["NOM_FORMATION"], $row["DOMAINE"], $row["NIVEAU"], $row["DATE_LIMITE"], $row["NBRE_PLACE_LIMITE"]);
        return $formation;
    }
}
