<?php
include('ResponsableF.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResponsableFSql
 *
 * @author machin
 */
class ResponsableFSql {
    //put your code here
    function getByNomUser($pdo,$user)
    {
        $req = $pdo->prepare("SELECT * FROM resp_form WHERE NOM_COMPTE_RESPFORM=?");
        $req->bindValue(1,$user);
        $req->execute();
        $row=$req->fetch();
            $gestionnaire=new ResponsableF($row["NOM_COMPTE_RESPFORM"], $row["MDP"], $row["NOM"], $row["PRENOM"],$row["EMAIL"]);
        return $gestionnaire;
    }
    
    function getConnexion($pdo, ResponsableF $g)
    {
        $req = $pdo->prepare("SELECT * FROM resp_form WHERE NOM_COMPTE_RESPFORM=? AND MDP=?");
        $req->bindValue(1,$g->getNomCompte());
        $req->bindValue(2,$g->getMdp());
        $req->execute();
        $row=$req->fetch();
            $gestionnaire=new ResponsableF($row["NOM_COMPTE_RESPFORM"], $row["MDP"], $row["NOM"], $row["PRENOM"],$row["EMAIL"]);
        return $gestionnaire;
    }
}
