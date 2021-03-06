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
        $req = $pdo->prepare("SELECT c.NO_CANDIDATURE, c.NO_DOC_LETTRE_MOTIVATION, c.NO_FORMATION, c.VERIFCATION, c.DATE, c.NO_DOSSIER FROM CANDIDATURE c, DOSSIER d WHERE c.NO_DOSSIER=d.NO_DOSSIER AND NOM_CANDIDAT=? ORDER BY DATE DESC");
        $req->bindValue(1,$user);
        $req->execute();
        foreach ($req as $row) {
            if($dossier==NULL)
            {
                $dossiersql=new DossierSql();
                $dossier=$dossiersql->getDossierById($pdo, $row['NO_DOSSIER']);
            }
            $docSql=new DocumentSql();
            $formationsql=new FormationSql();
            $candidature=new Candidature($row["NO_CANDIDATURE"],$docSql->getNomById($pdo, $row["NO_DOC_LETTRE_MOTIVATION"]) ,$dossier ,$formationsql->getById($pdo, $row["NO_FORMATION"]), $row['VERIFCATION'], $row["DATE"]);
            array_push($tabCandidature, $candidature);
        }
        return $tabCandidature;
    }
    
    function getCandidatureByUserAndEtat($pdo,$user,$etat)
    {
        $tabCandidature=array();
        $dossier=NULL;
        $req = $pdo->prepare("SELECT c.NO_CANDIDATURE, c.NO_DOC_LETTRE_MOTIVATION, c.NO_FORMATION, c.VERIFCATION, c.DATE, c.NO_DOSSIER FROM CANDIDATURE c, DOSSIER d WHERE c.NO_DOSSIER=d.NO_DOSSIER AND NOM_CANDIDAT=? AND c.VERIFCATION=?");
        $req->bindValue(1,$user);
        $req->bindValue(2,$etat);
        $req->execute();
        foreach ($req as $row) {
            if($dossier==NULL)
            {
                $dossiersql=new DossierSql();
                $dossier=$dossiersql->getDossierById($pdo, $row['NO_DOSSIER']);
            }
            $docSql=new DocumentSql();
            $formationsql=new FormationSql();
            $candidature=new Candidature($row["NO_CANDIDATURE"],$docSql->getNomById($pdo, $row["NO_DOC_LETTRE_MOTIVATION"]),$dossier ,$formationsql->getById($pdo, $row["NO_FORMATION"]), $row['VERIFCATION'], $row["DATE"]);
            array_push($tabCandidature, $candidature);
        }
        return $tabCandidature;
    }
    
    function getCandidatureById($pdo,$id)
    {
        $dossier=NULL;
        $req = $pdo->prepare("SELECT * FROM CANDIDATURE WHERE NO_CANDIDATURE=?");
        $req->bindValue(1,$id);
        $req->execute();
        $row=$req->fetch();
            if($dossier==NULL)
            {
                $dossiersql=new DossierSql();
                $dossier=$dossiersql->getDossierById($pdo, $row['NO_DOSSIER']);
            }
            $docSql=new DocumentSql();
            $formationsql=new FormationSql();
            $candidature=new Candidature($row["NO_CANDIDATURE"], $docSql->getNomById($pdo, $row["NO_DOC_LETTRE_MOTIVATION"]),$dossier ,$formationsql->getById($pdo, $row["NO_FORMATION"]), $row['VERIFCATION'], $row["DATE"]);
            return $candidature;
    }
    
    function getCandidatureByIdAndEtat($pdo,$id,$etat)
    {
        $tabCandidature=array();
        $dossier=NULL;
        $req = $pdo->prepare("SELECT * FROM CANDIDATURE WHERE NO_CANDIDATURE=? AND VERIFCATION=?");
        $req->bindValue(1,$id);
        $req->bindValue(2,$etat);
        $req->execute();
        foreach ($req as $row) {
            if($dossier==NULL)
            {
                $dossiersql=new DossierSql();
                $dossier=$dossiersql->getDossierById($pdo, $row['NO_DOSSIER']);
            }
            $docSql=new DocumentSql();
            $formationsql=new FormationSql();
            $candidature=new Candidature($row["NO_CANDIDATURE"],$docSql->getNomById($pdo, $row["NO_DOC_LETTRE_MOTIVATION"]),$dossier ,$formationsql->getById($pdo, $row["NO_FORMATION"]), $row['VERIFCATION'], $row["DATE"]);
            array_push($tabCandidature, $candidature);
        }
        return $tabCandidature;
    }
    
    function getCandidatureByFormationAndEtat($pdo,Formation $f,$etat)
    {
        $tabCandidature=array();
        $dossier=NULL;
        $req = $pdo->prepare("SELECT * FROM CANDIDATURE WHERE NO_FORMATION=? AND VERIFCATION=?");
        $req->bindValue(1,$f->getNo());
        $req->bindValue(2,$etat);
        $req->execute();
        foreach ($req as $row) {
            if($dossier==NULL)
            {
                $dossiersql=new DossierSql();
                $dossier=$dossiersql->getDossierById($pdo, $row['NO_DOSSIER']);
            }
            $docSql=new DocumentSql();
            $formationsql=new FormationSql();
            $candidature=new Candidature($row["NO_CANDIDATURE"],$docSql->getNomById($pdo, $row["NO_DOC_LETTRE_MOTIVATION"]),$dossier ,$formationsql->getById($pdo, $row["NO_FORMATION"]), $row['VERIFCATION'], $row["DATE"]);
            array_push($tabCandidature, $candidature);
        }
        return $tabCandidature;
    }
    
    function callProcedureSiDateDepasse($pdo)
    {
        $stmt = $pdo->prepare("CALL sp_check_date_candidature () ");
        // appel de la procédure stockée
        $stmt->execute();

    }
    
    function callProcedureRappel($pdo)
    {
        $tabR=array();
        $stmt = $pdo->prepare("CALL sp_candidature_date_rappel () ");
        // appel de la procédure stockée
        $stmt->execute();
        foreach ($stmt as $row) {
            $tabR[]=[$row["NO_CANDIDATURE"],$row["VERIFCATION"]];
        }
        return $tabR;
    }
    
    function donnerAvis($pdo,  Candidature $c)
    {
        try{
            $stmt = $pdo->prepare("UPDATE candidature SET VERIFCATION=?, DATE=DATE_ADD(NOW(), INTERVAL 10 DAY) WHERE NO_CANDIDATURE=? ");
            $stmt->bindValue(1,$c->getVerificaion());
            $stmt->bindValue(2,$c->getNo());
            $stmt->execute();
            
        }  catch (PDOException $e)
        {
            echo $e->getMessage();
            $stmt->debugDumpParams();
        }catch (Exception $e)
        {
            echo $e->getMessage();
            $stmt->debugDumpParams();
        }
    }
}
