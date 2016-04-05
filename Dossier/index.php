<?php
      
// put your code here
include("../modele/connexion.php");

include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/DossierSql.php");
include("../modele/PaysSql.php");
include("../modele/CandidatureSql.php");
include("../modele/FormationSql.php");
include("../modele/ResponsableFSql.php");
include("../modele/UniversiteSql.php");

session_start(); 
if(empty($_SESSION["dossier"]) && empty($_GET["noDossier"]))
{
    if(!empty($_SESSION["candidat"]))
    {
        $candidat=  unserialize($_SESSION["candidat"]);
        $dossierSql=new DossierSql();
        $dossier=$dossierSql->getDossierDuCandidat($pdo, $candidat);
    }else{
        // je ne sais pas quoi faire
    }
}else if(!empty($_SESSION["dossier"])){
    $dossier=  unserialize($_SESSION["dossier"]);
    $candidat=$dossier->getCandidat();
}else if(!empty($_GET["noDossier"])){
    $dossierSql=new DossierSql();
    $dossier=$dossierSql->getDossierById($pdo, $_GET["noDossier"]);
}


$candidatureSql=new CandidatureSql();
$tabCanditure=$candidatureSql->getCandidatureByUser($pdo, $candidat->getNom_candidat());
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="dossier.css" rel="stylesheet" type="text/css"/>
        <title>Dossier</title>
    </head>
    <body>
        <div id="nom_dossier">
            Dossier de l'étudiant <?php echo $candidat->getNom()." ".$candidat->getPrenom(); ?>
            <div id="etat_dossier">
                <?php echo $dossier->getVerification(); ?>
            </div>
                
        </div>
        <div id="coordonnes">
            <div>
                Nom : <?php echo $candidat->getNom(); ?>
            </div>
            <div>
                Prénom : <?php echo $candidat->getNom(); ?>
            </div>
            <div>
                Date de naissance : <?php echo $candidat->getDate_nais(); ?>
            </div>
            <div>
                Adresse mail : <?php echo $candidat->getEmail(); ?>
            </div>
            <div>
                Pays : <?php echo $candidat->getPays()->getNom_pays(); ?>
            </div>
            <div>
                Numéro de téléphone : <?php echo $candidat->getTelephone(); ?>
            </div>
        </div>
        
        <div id="candidature">
            <?php
                include("../vue/candidature.php");
            ?>
        </div>   
        <div id="document">
            
        </div>
        
        <div>
            <table id="avis">
                    <td id="positif"  onclick="location='https://www.google.fr'">
                        Accepter le dossier
                    </td>
                <td id="negatif">
                    Refuser le dossier
                </td>
            </table>
        </div>
        
        <?php
        // put your code here
        ?>
    </body>
</html>
