<?php
include("Candidat.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CandidatSql
 *
 * @author machin
 */
class CandidatSql {
    //put your code here
    
    function getCandidatByNomUser($pdo,$user)
    {
        $req = $pdo->prepare("SELECT * FROM candidat WHERE NOM_CANDIDAT=?");
        $req->bindValue(1,$user);
        $req->execute();
        $row=$req->fetch();
            $pays=new Pays($row["NO_PAYS"], "");
            $paysSql=new PaysSql();
            $pays=$paysSql->getPaysById($pdo, $pays->getId());
            $candidat=new Candidat($row["NOM_CANDIDAT"], $pays, $row["MDP"], $row["NOM"], $row["PRENOM"], $row["DATE_NAIS"], $row["EMAIL"], $row["TELEPHONE"]);
        return $candidat;
    }
    
    function getCandidatConnexion($pdo,  Candidat $c)
    {
        $req = $pdo->prepare("SELECT * FROM candidat WHERE NOM_CANDIDAT=? AND MDP=?");
        $req->bindValue(1,$c->getNom_candidat());
        $req->bindValue(1,$c->getMdp());
        $req->execute();
        $row=$req->fetch();
            $pays=new Pays($row["NO_PAYS"], "");
            $paysSql=new PaysSql();
            $pays=$paysSql->getPaysById($pdo, $pays->getId());
            $candidat=new Candidat($row["NOM_CANDIDAT"], $pays, $row["MDP"], $row["NOM"], $row["PRENOM"], $row["DATE_NAIS"], $row["EMAIL"], $row["TELEPHONE"]);
        return $candidat;
    }
    
    function getAll($pdo)
    {
        $tabCandidat=array();
        $req = $pdo->prepare("SELECT * FROM candidat");
        $req->execute();
        foreach ($req as $row) {
            $pays=new Pays($row["NO_PAYS"], "");
            $paysSql=new PaysSql();
            $pays=$paysSql->getPaysById($pdo, $pays->getId());
            $candidat=new Candidat($row["NOM_CANDIDAT"], $pays, $row["MDP"], $row["NOM"], $row["PRENOM"], $row["DATE_NAIS"], $row["EMAIL"], $row["TELEPHONE"]);
            array_push($tabCandidat, $candidat);
        }
        return $tabCandidat;
    }
    
    function checkExistEmail($pdo,$email)
    {
        
    }
    
    function checkExistUser($pdo,$user)
    {
        
    }
    
    function checkExistPhone($pdo,$phone)
    {
        
    }
    
}
