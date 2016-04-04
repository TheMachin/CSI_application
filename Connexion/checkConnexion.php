<?php
include("../modele/connexion.php");
include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/ResponsableF.php");
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

if($_POST["type"]=="candidat")
{
    
}