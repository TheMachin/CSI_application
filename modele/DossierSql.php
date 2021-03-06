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
    
    function getDossierDuCandidat($pdo,$user)
    {
        $req = $pdo->prepare("SELECT * FROM DOSSIER WHERE NOM_CANDIDAT=?");
        $req->bindValue(1,$user);
        $req->execute();
        $row=$req->fetch();
            $candidatSql=new CandidatSql();
            $gestionnaireSql=new GestionnaireSql();
            $dossier= new Dossier($row["NO_DOSSIER"], $candidatSql->getCandidatByNomUser($pdo, $row["NOM_CANDIDAT"]), $gestionnaireSql->getGestionnaireByNomUser($pdo, $row["NOM_GESTIONNAIRE"]), $row["VERIFCATION"]);
        return $dossier;
    }
    
    function getDossierCandidatByGestionnaire($pdo,$gestionnaire)
    {
        $tabD=array();
        $req = $pdo->prepare("SELECT * FROM DOSSIER WHERE NOM_GESTIONNAIRE=? AND (VERIFCATION IS NULL OR VERIFCATION='en cours')");
        $req->bindValue(1,$gestionnaire);
        $req->execute();
        $candidatSql=new CandidatSql();
        $candidatureSql=new CandidatureSql();
        $gestionnaireSql=new GestionnaireSql();
        foreach ($req as $row) {
            $dossier= new Dossier($row["NO_DOSSIER"], $candidatSql->getCandidatByNomUser($pdo, $row["NOM_CANDIDAT"]), $gestionnaireSql->getGestionnaireByNomUser($pdo, $row["NOM_GESTIONNAIRE"]), $row["VERIFCATION"]);
            $dossier->setTabCandidature($candidatureSql->getCandidatureByUser($pdo, $dossier->getCandidat()->getNom_candidat()));
            $tabD[]=$dossier;
            
        }
            return $tabD;
    }
    
    function getDossierCandidatMemePaysQueGestionnaire($pdo,  Gestionnaire $g)
    {
        $tabD=array();
        $req = $pdo->prepare("SELECT * FROM DOSSIER d, candidat c WHERE d.nom_gestionnaire IS NULL AND d.NOM_CANDIDAT = c.NOM_CANDIDAT AND c.NO_PAYS=? AND (VERIFCATION IS NULL OR VERIFCATION='en cours')");
        $req->bindValue(1,$g->getPays()->getId());
        $req->execute();
        $candidatSql=new CandidatSql();
        $gestionnaireSql=new GestionnaireSql();
        foreach ($req as $row) {
            $dossier= new Dossier($row["NO_DOSSIER"], $candidatSql->getCandidatByNomUser($pdo, $row["NOM_CANDIDAT"]), $gestionnaireSql->getGestionnaireByNomUser($pdo, $row["NOM_GESTIONNAIRE"]), $row["VERIFCATION"]);
            $tabD[]=$dossier;
            
        }
            return $tabD;
    }
    
    /**
     * Mettre à jour le champ verifcation d'un dossier
     * Un trigger va refuser les candidatures du candidat si l'avis est négatif
     * @param type $pdo connexion  à la bdd
     * @param Dossier $d Classe Dossier
     */
    function donnerAvis($pdo,Dossier $d)
    {
        $g=$d->getGestionnaire();
        try{
            $stmt = $pdo->prepare("UPDATE dossier SET NOM_GESTIONNAIRE=?,VERIFCATION=? WHERE NO_DOSSIER=?");
            $stmt->bindValue(1,$g->getNomCompte());
            $stmt->bindValue(2,$d->getVerification());
            $stmt->bindValue(3,$d->getNo());
            $stmt->execute();
            //$stmt->debugDumpParams();
        }  catch (PDOException $e)
        {
            echo $e->getMessage();
        }catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
}
