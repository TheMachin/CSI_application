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
                L'état du dossier est : <?php echo $dossier->getVerification(); ?>
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
             <?php
                include("../vue/document.php");
            ?>
        </div>
        
        
    </body>
</html>