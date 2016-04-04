<?php
session_start();

if(empty($_SESSION["candidat"]))
{
    header('Location: connexion.php');   
}else{
    $candidat=  unserialize($_SESSION["candidat"]);
}


include("../modele/connexion.php");

include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/DossierSql.php");
include("../modele/PaysSql.php");
include("../modele/CandidatureSql.php");
include("../modele/FormationSql.php");
include("../modele/ResponsableFSql.php");
include("../modele/UniversiteSql.php");


$candidatureSql=new CandidatureSql();
$tabCanditure=$candidatureSql->getCandidatureByUser($pdo, $candidat->getNom_candidat());
if(count($tabCanditure)>0)
{
    $dossier=$tabCanditure[0]->getDossier();
}else{
    $dossiersql=new DossierSql();
    $dossier=$dossiersql->getDossierDuCandidat($pdo, $candidat->getNom_candidat());
}

$_SESSION["dossier"]=  serialize($dossier);

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
        <title>Accueil</title>
    </head>
    <body>
        
        <div id="dossier">
            Accéder au dossier <a href="../Dossier/index.php" >Cliquez sur ce lien </a>
        </div>
        <?php
        // put your code here
        ?>
        <div id="candidature">
            <?php include("../vue/candidature.php"); ?>
        </div>
        
        <div id="candidater">
            
        </div>
    </body>
</html>
