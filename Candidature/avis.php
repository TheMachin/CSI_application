<?php
include("../modele/connexion.php");

include("../modele/CandidatureSql.php");
include("../modele/CandidatSql.php");
include("../modele/PaysSql.php");
include("../modele/FormationSql.php");
include("../modele/ResponsableFSql.php");
include("../modele/UniversiteSql.php");
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

/*if(!empty($_SESSION["responsable"]))
{
    $r=  unserialize($_SESSION["responsable"]);
}else{
    header("location:". $_SERVER['HTTP_REFERER']);
    exit();
}
*/
 if(isset($_GET["noCand"]))
{
    $candidature=$cSql->getCandidatureById($pdo, $_GET["noCand"]);
}else{
    header("location:". $_SERVER['HTTP_REFERER']);
    
    exit();
}

if(!empty($_SESSION["raison"]))
{
    $candidature->setVerificaion("refusé");
    
    $cSql->donnerAvis($pdo, $candidature);
    unset($_SESSION["raison"]);
    $url=$_SESSION['url'];
    unset($_SESSION['url']);
    header('Location:'. $url);
    exit();
}else if($_GET["avis"]==="P")
{
    $candidature->setVerificaion("accepté");
}else if($_GET["avis"]==="R"){
    
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
        <form method="POST">
            <div>
                <label>Exprimer la raison de refus</label>
                <TEXTAREA NAME="raison" ROWS="5" >
                </TEXTAREA> 
                <input type="hidden" id="document" name="noCand" value="<?php echo $_GET["noCand"]; ?>" class="form-control">
            </div>
            <div>
		<input type="submit" id="valider" name="valider" value="Valider" class="btn btn-success">
            </div>
        </form>
    </body>
</html>


    <?php
    $_SESSION["raison"]="La raison est que...";
    if(empty($_SESSION['url']))
    {
        $_SESSION['url']=$_SERVER['HTTP_REFERER'];
    }
    exit();
    //$candidature->setVerificaion("refusé");
}else if($_GET["avis"]==="A"){
    $candidature->setVerificaion("annulé");
}else if($_GET["avis"]==="C"){
    $candidature->setVerificaion("confirmé");
}else{
    header("location:". $_SERVER['HTTP_REFERER']);
    exit();
}


$cSql->donnerAvis($pdo, $candidature);

/**Si avis négatif Alors
 *      Envoie d'un mail au candidat pour dire que son dossier a été refusé
 * Sinon rien
 * 
 */

header("location:". $_SERVER['HTTP_REFERER']);
exit();