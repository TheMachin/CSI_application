<?php
include("../modele/connexion.php");

include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/DossierSql.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
$dossiersql=new DossierSql();
$dossier=NULL;
$g=NULL;
if(!empty($_SESSION["dossier"]))
{
    $dossier=  unserialize($_SESSION["dossier"]);
}else{
    echo "dossier vide";
    //header("location:". $_SERVER['HTTP_REFERER']);
    //exit();
}

if(!empty($_SESSION["gestionnaire"]))
{
    $g=  unserialize($_SESSION["gestionnaire"]);
}else{
    echo "gestionnaire vide";
    //header("location:". $_SERVER['HTTP_REFERER']);
    //exit();
}

$dossier->setGestionnaire($g);

if($_GET["a"]==="1")
{
    $dossier->setVerification("accepté");
}else if($_GET["a"]==="0"){
    $dossier->setVerification("refusé");
}

$dossiersql->donnerAvis($pdo, $dossier);
//var_dump($dossier);
/**Si avis négatif Alors
 *      Envoie d'un mail au candidat pour dire que son dossier a été refusé
 * Sinon rien
 * 
 */

header("location:". $_SERVER['HTTP_REFERER']);
exit();