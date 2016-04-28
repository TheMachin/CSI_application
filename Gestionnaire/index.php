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

$gestionnaire=NULL;//new Gestionnaire($nomCompte, $pays, $mdp, $nom, $prenom);
$gSql=new GestionnaireSql();
$dSql=new DossierSql();

if(empty($_SESSION['user']))
{
    header('Location: connexion.php');  
    exit;
}

if($_SESSION['user']==="gestionnaire")
{
    if(!empty($_SESSION['gestionnaire'])){
        $gestionnaire=  unserialize($_SESSION['gestionnaire']);
    }
}else{
    header('Location: connexion.php');  
    exit;
}

$TabDossier=array();
$TabDossier=$dSql->getDossierCandidatByGestionnaire($pdo, $gestionnaire->getNomCompte());
$TabDossier=  array_merge($TabDossier,$dSql->getDossierCandidatMemePaysQueGestionnaire($pdo, $gestionnaire));



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
        <h1>Page d'accueil du gestionnaire</h1>
        <div id="nom prenom">
            <p>Nom : <?php echo $gestionnaire->getNom(); ?></p>
            <p>Prenom : <?php echo $gestionnaire->getPrenom(); ?></p>
        </div>
        <div>
            <?php 
                include("../vue./listDossier.php");
            ?>
        </div>
        <?php
        // put your code here
        ?>
        
    </body>
</html>
