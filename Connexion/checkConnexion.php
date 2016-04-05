<?php
include("../modele/connexion.php");
include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/ResponsableFSql.php");
include("../modele/PaysSql.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$bool=true; // boolean qui passe à true si toutes les valeurs sont renseignées sinon il passe à false
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
    $pays=new Pays(0, "");
    $candidat=$candidatSql->getCandidatConnexion($pdo, new Candidat($user, $pays, $mdp, "", "", "", "", ""));
    
    if(empty($candidat->getNom_candidat())){
        echo "here";
        session_start();
        $_SESSION["msgErreur"]="Nom d'utilisateur ou mot de passe incorrecte";
        header("location:". $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    session_start();
    $_SESSION["candidat"]=  serialize($candidat);
    
}else if($_POST["type"]==="gestionnaire")
{
    //$gestionnaire=new Gestionnaire($user, NULL, $mdp, "", "");
    $pays=new Pays(0, "");
    $gestionnaireSql=new GestionnaireSql();
    $gestionnaire=$gestionnaireSql->getGestionnaireConnexion($pdo, new Gestionnaire($user, $pays, $mdp, "", ""));  
    
    if(empty($gestionnaire->getNomCompte())){
        echo "here";
        session_start();
        $_SESSION["msgErreur"]="Nom d'utilisateur ou mot de passe incorrecte";
        header("location:". $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    session_start();
    $_SESSION["gestionnaire"]=  serialize($gestionnaire);
    
}else if($_POST["type"]==="responsable"){
    //$responsable=new ResponsableF($user, NULL, $mdp, "", "");
    $responsableSql=new ResponsableFSql();
    $pays=new Pays(0, "");
    $responsable=$responsableSql->getConnexion($pdo, new ResponsableF($user, $pays, $mdp, "", ""));  
    
    if(empty($responsable->getNomCompte())){
        echo "here";
        session_start();
        $_SESSION["msgErreur"]="Nom d'utilisateur ou mot de passe incorrecte";
        header("location:". $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    session_start();
    $_SESSION["responsable"]=  serialize($responsable);
    
}else{
    echo "ooi";
}
