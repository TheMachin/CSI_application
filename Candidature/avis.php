<?php
include("../modele/connexion.php");

include("../modele/CandidatureSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/DossierSql.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
$cSql=new CandidatureSql();
$candidature=NULL;
$r=NULL;

if(!empty($_SESSION["responsable"]))
{
    $r=  unserialize($_SESSION["responsable"]);
}else{
    header("location:". $_SERVER['HTTP_REFERER']);
    exit();
}

if(isset($_GET["noCand"]))
{
    $candidature=$cSql->getCandidatureById($pdo, $_GET["noCand"]);
}else{
    header("location:". $_SERVER['HTTP_REFERER']);
    exit();
}

if($_GET["avis"]==="P")
{
    $candidature->setVerificaion("accepté");
}else if($_GET["avis"]==="R"){
    $candidature->setVerificaion("refusé");
}else{
    header("location:". $_SERVER['HTTP_REFERER']);
    exit();
}

$candidature->setDate(date());

$cSql->donnerAvis($pdo, $candidature);

/**Si avis négatif Alors
 *      Envoie d'un mail au candidat pour dire que son dossier a été refusé
 * Sinon rien
 * 
 */

header("location:". $_SERVER['HTTP_REFERER']);
exit();