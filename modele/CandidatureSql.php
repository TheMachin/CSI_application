<?php
include("Candidature.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CandidatureSql
 *
 * @author machin
 */
class CandidatureSql {
    //put your code here
    
    /**
     * 
     * @param type $pdo base de données
     * @param type $user Le nom du compte du candidat
     * @return array un tableau contenant les candidatures
     */
    function getCandidatureByUser($pdo,$user)
    {
        $tabCandidature=array();
        $dossier=NULL;
        $req = $pdo->prepare("SELECT * FROM CANDIDATURE c, DOSSIER d WHERE c.NO_DOSSIER=d.NO_DOSSIER AND NOM_CANDIDAT=?");
        $req->bindValue(1,$user);
        $req->execute();
        foreach ($req as $row) {
            if($dossier==NULL)
            {
                $dossiersql=new DossierSql();
                $dossier=$dossiersql->getDossierById($pdo, $row['NO_DOSSIER']);
            }
            
            $formationsql=new FormationSql();
            $candidature=new Candidature($row["NO_CANDIDATURE"], $row["NO_DOC_LETTRE_MOTIVATION"],$dossier ,$formationsql->getById($pdo, $row["NO_FORMATION"]), $row['VERIFICATION'], $row["DATE"]);
            array_push($tabCandidature, $candidature);
        }
        return $tabCandidature;
    }
}
