<?php
include("Gestionnaire.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GestionnaireSql
 *
 * @author machin
 */
class GestionnaireSql {
    //put your code here
    function getGestionnaireByNomUser($pdo,$user)
    {
        $req = $pdo->prepare("SELECT * FROM GESTIONNAIRE WHERE NOM_COMPTE=?");
        $req->bindValue(1,$user);
        $req->execute();
        $row=$req->fetch();
            $pays=new Pays($row["NO_PAYS"], "");
            $paysSql=new PaysSql();
            $pays->setNom_pays($paysSql->getPaysById($pdo, $pays->getId()));
            $gestionnaire=new Gestionnaire($row["NOM_COMPTE"], $pays, $row["MDP"], $row["NOM"], $row["PRENOM"]);
        return $gestionnaire;
    }
}
