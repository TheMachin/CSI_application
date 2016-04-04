<?php
include('Dossier.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DossierSql
 *
 * @author machin
 */
class DossierSql {
    //put your code here
    function getDossierById($pdo,$id)
    {
        $req = $pdo->prepare("SELECT * FROM DOSSIER WHERE NO_DOSSIER=?");
        $req->bindValue(1,$id);
        $req->execute();
        $row=$req->fetch();
            $candidatSql=new CandidatSql();
            $gestionnaireSql=new GestionnaireSql();
            $dossier= new Dossier($row["NO_DOSSIER"], $candidatSql->getCandidatByNomUser($pdo, $row["NOM_CANDIDAT"]), $gestionnaireSql->getGestionnaireByNomUser($pdo, $row["NOM_GESTIONNAIRE"]), $row["VERIFCATION"]);
        return $dossier;
    }
}
