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
        $req->bindValue(2,$c->getMdp());
        $req->execute();
        $row=$req->fetch();
            $paysSql=new PaysSql();
            $pays=$paysSql->getPaysById($pdo,$row["NO_PAYS"]);
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
    
    function ajoutCandidat($pdo,  Candidat $c)
    {
        $no=0;
        $stmt = $pdo->prepare("CALL sp_ajout_etudiant (:nomCompte,:noPays,:mdp,:nom,:prenom,:date,:mail,:tel) ");
        $nomCompte=$c->getNom_candidat();
        $stmt->bindParam(":nomCompte", $nomCompte);
        $idPays=$c->getPays()->getId();
        $stmt->bindParam(":noPays", $idPays);
        $mdp=$c->getMdp();
        $stmt->bindParam(":mdp", $mdp);
        $nom=$c->getNom();
        $stmt->bindParam(":nom", $nom);
        $prenom=$c->getPrenom();
        $stmt->bindParam(":prenom", $prenom);
        $date=$c->getDate_nais();
        $stmt->bindParam(":date", $date);
        $email=$c->getEmail();
        $stmt->bindParam(":mail", $email);
        $tel=$c->getTelephone();
        $stmt->bindParam(":tel", $tel);
        //$stmt->bindParam(":no", $no);

        // appel de la procédure stockée
        $stmt->execute();
        $row=$stmt->fetch();
        /*var_dump($pdo->errorInfo());
        echo($stmt->errorCode());
        var_dump($stmt->errorInfo());
        return $no;*/
        return $row['id'];

    }
    
}
