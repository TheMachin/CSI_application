<?php
        // put your code here
include("../modele/connexion.php");

include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/DossierSql.php");
include("../modele/PaysSql.php");

//$candidat=new Candidat("", NULL, "", "", "", "", "", "");
$dossierSql=new DossierSql();
$dossier=$dossierSql->getDossierById($pdo, 1);
$candidat=$dossier->getCandidat();
$gestionnaire=$dossier->getGestionnaire();

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
            <!--<div>
                Adresse : <?php //echo $candidat->getPrenom(); ?>
            </div>-->
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
