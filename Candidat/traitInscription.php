<?php
include("../modele/connexion.php");
include("../modele/PaysSql.php");
include("../modele/CandidatSql.php");
include("../modele/DossierSql.php");
include("../modele/DocumentSql.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ 

session_start();

$bool=TRUE;
$pays=new Pays(0, "");
$candidat=new Candidat("",$pays , "", "", "", "", "", "");

if(empty($_POST["user"]))
{
    $bool=FALSE;
}else{
    $candidat->setNom_candidat($_POST["user"]);
}

if(empty($_POST["pwd"]))
{
    $bool=FALSE;
}else{
    if(empty($_POST["pwd2"]))
    {
        $bool=FALSE;
    }else{
        if($_POST["pwd"]===$_POST["pwd2"])
        {
            $candidat->setMdp(sha1($_POST["pwd"]));
        }else{
            $bool=FALSE;
        }
    }
    
}

if(empty($_POST["pays"]))
{
    $bool=FALSE;
}else{
    $pays=new Pays($_POST["pays"], "");
    $candidat->setPays($pays);
}


if(empty($_POST["nom"]))
{
    $bool=FALSE;
}else{
    $candidat->setNom($_POST["nom"]);
}

if(empty($_POST["prenom"]))
{
    $bool=FALSE;
}else{
    $candidat->setPrenom($_POST["prenom"]);
}

if(empty($_POST["email"]))
{
    $bool=FALSE;
}else{
    $candidat->setEmail($_POST["email"]);
}

if(empty($_POST["dateN"]))
{
    $bool=FALSE;
}else{
    $candidat->setDate_nais($_POST["dateN"]);
}

if(empty($_POST["tel"]))
{
    $bool=FALSE;
}else{
    $candidat->setTelephone($_POST["tel"]);
}

$nbreDoc=0;
if(empty($_POST["nbreDoc"]))
{
    $bool=FALSE;
}else{
    $nbre=$_POST["nbreDoc"];
}

if($bool==FALSE)
{
    $_SESSION["msgErreur"]="Le champ du nom d'utilisateur ou du mot de passe est/sont vide(s)";
    header("location:". $_SERVER['HTTP_REFERER']);
    exit();
}

$tabDoc=array();
$no=0;
$i=0;
for($i=1;$i<$nbre+1;$i++)
{
    $type;
    if($_POST["type".$i]==="diplome")
    {
        $type="Justificatif de diplôme";
    }else if($_POST["type".$i]==="note")
    {
        $type="Relevé de note";
    }
    $tabDoc[$i-1]=new Document($no, $_POST["document".$i],$type);
    
    
}

    $dossier=new Dossier(0, $candidat, "", "");
    $dossier->setTabD($tabDoc);
    
    $candidatSql=new CandidatSql();
    
    $dossier->setNo($candidatSql->ajoutCandidat($pdo, $candidat));
    
    $docSql=new DocumentSql();
    $docSql->insertDocument($pdo, $dossier);

    
    /**
     * mise en place des sessions
     */
    $_SESSION["dossier"]=  serialize($dossier);
    $_SESSION["candidat"]=  serialize($candidat);
    $_SESSION["type"]="candidat";

    header('Location: ../Candidat/index.php');
