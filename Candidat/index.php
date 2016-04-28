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

if(empty($_SESSION["candidat"]))
{
    header('Location: connexion.php');   
}else{
    $candidat=  unserialize($_SESSION["candidat"]);
}

if(empty($_SESSION["type"]))
{
      $_SESSION["type"]="candidat";
}

$candidatureSql=new CandidatureSql();



if(empty($_SESSION["dossier"]))
{
    if(count($tabCanditure)>0)
    {
        $dossier=$tabCanditure[0]->getDossier();
    }else{
        $dossiersql=new DossierSql();
        $dossier=$dossiersql->getDossierDuCandidat($pdo, $candidat->getNom_candidat());
    }
    $_SESSION["dossier"]=  serialize($dossier);
}else{
    $dossier=  unserialize($_SESSION["dossier"]);
}

if(!empty($_POST))
{
    $req = $pdo->prepare('INSERT INTO document(NOM_DOC, TYPE_DOC) VALUES(:NOM_DOC, :TYPE_DOC)');
    $req->execute(array(
        'NOM_DOC' => $_POST['ldm'],
        'TYPE_DOC' => "Lettre de motivation"
    ));
    
    $dos = $pdo->query('SELECT NO_DOSSIER
    FROM dossier
    WHERE NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
    
    $doc = $pdo->query('SELECT NO_DOC
    FROM document
    WHERE type_doc = "Lettre de motivation"
    ORDER BY NO_DOC DESC LIMIT 0, 1');
    
    $doss = $dos->fetch();
    $docc = $doc->fetch();
    
    $req2 = $pdo->prepare('INSERT INTO contient_document(NO_DOC, NO_DOSSIER) VALUES(:NO_DOC, :NO_DOSSIER)');
    $req2->execute(array(
        'NO_DOC' => $docc['NO_DOC'],
        'NO_DOSSIER' => $doss['NO_DOSSIER']
    ));
    $var = 'La nouvelle lettre de motivation a bien ete ajoutee';
    
    $insert = $pdo->prepare('INSERT INTO candidature(NO_DOC_LETTRE_MOTIVATION, NO_DOSSIER, NO_FORMATION) VALUES(:NO_DOC_LETTRE_MOTIVATION, :NO_DOSSIER, :NO_FORMATION)');
    $insert->execute(array(
        'NO_DOC_LETTRE_MOTIVATION' => $docc['NO_DOC'],
        'NO_DOSSIER' => $doss['NO_DOSSIER'],
        'NO_FORMATION' => $_POST['no_form']
    ));
    $var2 = 'La candidature a ete envoyee a la formation !';
}



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
        <?php
        if(!empty($var))
        {
           echo '<p>'.$var.'</p>'; 
        }
        if(!empty($var2))
        {
           echo '<p>'.$var2.'</p>'; 
        }
            echo '<p>Bonjour '. $candidat->getPrenom(). ' '. $candidat->getNom() .' !</p>';
        ?>
        <div id="dossier">
            Accéder au dossier <a href="../Dossier/index.php" >Cliquez sur ce lien </a>
        </div>
        <?php
        // put your code here
            
        ?>
        <div id="candidature A">
            <?php 
                $tabCanditure=$candidatureSql->getCandidatureByUserAndEtat($pdo, $candidat->getNom_candidat(),"accepté");
                include("../vue/candidature.php"); ?>
        </div>
        
        <div id="candidature E">
            <?php 
                $tabCanditure=$candidatureSql->getCandidatureByUserAndEtat($pdo, $candidat->getNom_candidat(),"en cours");
                include("../vue/candidature.php"); ?>
        </div>
        
        <div id="candidature R">
            <?php 
                $tabCanditure=$candidatureSql->getCandidatureByUserAndEtat($pdo, $candidat->getNom_candidat(),"refusé");
                include("../vue/candidature.php"); ?>
        </div>
        
        <div id="candidater">
            <a href="candidater.php">Ajouter une candidature</a>
        </div>
    </body>
</html>
