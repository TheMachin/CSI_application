<?php
include("../modele/connexion.php");

include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/DossierSql.php");
include("../modele/DocumentSql.php");
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

if(!empty($_SESSION["raison"]))
{
    $dossier->setVerification("refusé");
    $dossiersql->donnerAvis($pdo, $dossier);
//var_dump($dossier);
/**Si avis négatif Alors
 *      Envoie d'un mail au candidat pour dire que son dossier a été refusé
 * Sinon rien
 * 
 */
    unset($_SESSION["raison"]);
    header('Location: ../Gestionnaire/index.php');
    exit();
}else if(isset($_GET["a"]) && $_GET["a"]==="1")
{
    $dossier->setVerification("accepté");
}else if(isset($_GET["a"]) && $_GET["a"]==="0"){
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
        <title>Exprimer la raison du refus</title>
    </head>
    <body>
        <form method="POST" action="avis.php">
            <div>
                <label>Exprimer la raison de refus</label>
                <TEXTAREA NAME="raison" ROWS="5" >
                </TEXTAREA> 
                <input type="hidden" id="valider" name="truc" value="Valider" class="btn btn-success">
            </div>
            <div>
		<input type="submit" id="valider" name="valider" value="Valider" class="btn btn-success">
            </div>
        </form>
    </body>
</html>
   

    <?php
     unset($_GET["a"]);
     $_SESSION["raison"]="La raison est que...";
    exit();
    //$dossier->setVerification("refusé");
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