<?php
include("../modele/connexion.php");
include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/ResponsableFSql.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$boolChamp=true; // boolean qui passe à true si toutes les valeurs sont renseignées sinon il passe à false
if(empty($_POST["user"]))
{
    $bool=false;
}else{
    $user=$_POST["user"];
}

if(empty($_POST["pwd"]))
{
    $bool=false;
}else{
    $mdp=sha1($_POST["pwd"]);
}

if($bool==FALSE)
{
    header("location:". $_SERVER['HTTP_REFERER']);
    exit();
}

if($_POST["type"]==="candidat")
{
    $candidatSql=new CandidatSql();
    //$candidat=new Candidat($user, NULL, $mdp, "", "", "", "", "");
    $candidat=$candidatSql->getCandidatConnexion($pdo, new Candidat($user, NULL, $mdp, "", "", "", "", ""));
    
    if($candidat==NULL){
        header("location:". $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    session_start();
    $_SESSION["candidat"]=  serialize($candidat);
    
}else if($_POST["type"]==="gestionnaire")
{
    //$gestionnaire=new Gestionnaire($user, NULL, $mdp, "", "");
    $gestionnaireSql=new GestionnaireSql();
    $gestionnaire=$gestionnaireSql->getGestionnaireConnexion($pdo, new Gestionnaire($user, NULL, $mdp, "", ""));  
    
    if($gestionnaire==NULL){
        header("location:". $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    session_start();
    $_SESSION["gestionnaire"]=  serialize($gestionnaire);
    
}else if($_POST["type"]==="responsable"){
    //$responsable=new ResponsableF($user, NULL, $mdp, "", "");
    $responsableSql=new ResponsableFSql();
    $responsable=$responsableSql->getConnexion($pdo, new ResponsableF($user, NULL, $mdp, "", ""));  
    
    if($responsable==NULL){
        header("location:". $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    session_start();
    $_SESSION["responsable"]=  serialize($responsable);
    
}