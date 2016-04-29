<?php


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
$formationSql=new FormationSql();
$candidatureSql=new CandidatureSql();
$formation=NULL;
$universite=NULL;
$responsable=NULL;
if(empty($_SESSION["responsable"]))
{
    header('Location: connexion.php');   
}else{
    $responsable=  unserialize($_SESSION["responsable"]);
}

$formation=$formationSql->getByResponsable($pdo, $responsable->getNomCompte());
$universite=$formation->getUniversite();
$tabCanditure=$candidatureSql->getCandidatureByFormationAndEtat($pdo, $formation, "en cours");

$tabCanditureA=$candidatureSql->getCandidatureByFormationAndEtat($pdo, $formation, "accepté");
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
        <title></title>
    </head>
    <body>
        <h1>Page d'accueil du responsable de diplome</h1>
        <div id="nom prenom">
            <p>Nom : <?php echo $responsable->getNom(); ?></p>
            <p>Prenom : <?php echo $responsable->getPrenom(); ?></p>
        </div>
        <div id="formation">
            <p>Nom Formation : <?php echo $formation->getNomFormation(); ?></p>
            <p>Domaine : <?php echo $formation->getDomaine(); ?></p>
            <p>Niveau : <?php echo $formation->getNiveau(); ?></p>
            <p>Date limite : <?php echo $formation->getDateLimite(); ?></p>
            <p>Nombre de place maximum : <?php echo $formation->getNbrePlaceLimite(); ?></p>
        </div>
        <div id="universite">
            <p>Nom université : <?php echo $universite->getNom_univ(); ?></p>
            <p>Ville : <?php echo $universite->getVille(); ?></p>
        </div>
        <h2>Candidature en attente</h2>
        <div id="candidature E">
            <?php include("../vue/candidature.php"); ?>
        </div>
        
        <h2>Candidature accepté</h2>
        <div id="candidature A">
            <?php 
                $tabCanditure=$tabCanditureA;
                include("../vue/candidature.php"); 
            ?>
        </div>
    </body>
</html>