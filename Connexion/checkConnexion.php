<?php
session_start();

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
    $_SESSION["msgErreur"]="Le champ du nom d'utilisateur ou du mot de passe est/sont vide(s)";
    header("location:". $_SERVER['HTTP_REFERER']);
    exit();
}

/**
 * On vérifie si c'est un candidat ou un gestionnaire ou un responsable de formaton qui se connecte
 * On vérifie avec la bdd si la personne est déjà renseigné et que le mot de passe existe
 * si c'est le cas, on enregistre la personne dans une variable session
 * sinon on revient à la page de connexion et un message d'erreur sera affiché
 */
if($_POST["type"]==="candidat")
{
    $candidatSql=new CandidatSql();
    //$candidat=new Candidat($user, NULL, $mdp, "", "", "", "", "");
    $pays=new Pays(0, "");
    $candidat=$candidatSql->getCandidatConnexion($pdo, new Candidat($user, $pays, $mdp, "", "", "", "", ""));
    
    if(empty($candidat->getNom_candidat())){
        $_SESSION["msgErreur"]="Nom d'utilisateur ou mot de passe incorrecte";
        header("location:". $_SERVER['HTTP_REFERER']);
        exit();
    }
    

    $_SESSION["candidat"]=  serialize($candidat);
    $_SESSION["user"]="candidat"; // l'utilisateur connecté est un candidat
    header('Location: ../Candidat/index.php');
    exit();
    
}else if($_POST["type"]==="gestionnaire")
{
    //$gestionnaire=new Gestionnaire($user, NULL, $mdp, "", "");
    $pays=new Pays(0, "");
    $gestionnaireSql=new GestionnaireSql();
    $gestionnaire=$gestionnaireSql->getGestionnaireConnexion($pdo, new Gestionnaire($user, $pays, $mdp, "", ""));  
    
    if(empty($gestionnaire->getNomCompte())){
        $_SESSION["msgErreur"]="Nom d'utilisateur ou mot de passe incorrecte";
        header("location:". $_SERVER['HTTP_REFERER']);
        exit();
    }
    

    $_SESSION["gestionnaire"]=  serialize($gestionnaire);
    $_SESSION["user"]="gestionnaire"; // l'utilisateur connecté est un gestionnaire
    header('Location: ../Gestionnaire/index.php');
    exit();
    
}else if($_POST["type"]==="responsable"){
    //$responsable=new ResponsableF($user, NULL, $mdp, "", "");
    $responsableSql=new ResponsableFSql();
    $pays=new Pays(0, "");
    $responsable=$responsableSql->getConnexion($pdo, new ResponsableF($user, $mdp, "", "",""));  
    
    if(empty($responsable->getNomCompte())){
        $_SESSION["msgErreur"]="Nom d'utilisateur ou mot de passe incorrecte";
        header("location:". $_SERVER['HTTP_REFERER']);
        exit();
    }
    

    $_SESSION["responsable"]=  serialize($responsable);
    $_SESSION["user"]="responsable"; // l'utilisateur connecté est un responsable de formation
    header('Location: ../RespForm/index.php');
    exit();
    
}else{
    $_SESSION["msgErreur"]="Nom d'utilisateur ou mot de passe incorrecte";
    header("location:". $_SERVER['HTTP_REFERER']);
    exit();
}
