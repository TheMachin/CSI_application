<?php
      
// put your code here
include("../modele/connexion.php");
include("../vue/deconnexion.php");
include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/DossierSql.php");
include("../modele/DocumentSql.php");
include("../modele/PaysSql.php");
include("../modele/CandidatureSql.php");
include("../modele/FormationSql.php");
include("../modele/ResponsableFSql.php");
include("../modele/UniversiteSql.php");

session_start(); 

if(!empty($_SESSION["candidat"]))
    {
        $candidat=  unserialize($_SESSION["candidat"]);
        $dossierSql=new DossierSql();
        $dossier=$dossierSql->getDossierDuCandidat($pdo, $candidat->getNom_candidat());
    }

if(empty($_SESSION["dossier"]) && empty($_GET["noDossier"]))
{
    if(!empty($_SESSION["candidat"]))
    {
        $candidat=  unserialize($_SESSION["candidat"]);
        $dossierSql=new DossierSql();
        $dossier=$dossierSql->getDossierDuCandidat($pdo, $candidat->getNom_candidat());
    }else{
        // je ne sais pas quoi faire
    }
}else if(!empty($_SESSION["dossier"])){
    $dossier=  unserialize($_SESSION["dossier"]);
    $candidat=$dossier->getCandidat();
}else if(!empty($_GET["noDossier"])){
    $dossierSql=new DossierSql();
    $dossier=$dossierSql->getDossierById($pdo, $_GET["noDossier"]);
    $candidat=$dossier->getCandidat();
}
$_SESSION["candidat"]=  serialize($candidat);

$candidatureSql=new CandidatureSql();
$tabCanditure=$candidatureSql->getCandidatureByUser($pdo, $candidat->getNom_candidat());
if(count($dossier->getTabD())==0)
{
    $docSql=new DocumentSql();
    $dossier->setTabD($docSql->getAllDocumentByDossier($pdo, $dossier));
    //$_SESSION["dossier"]=  serialize($dossier);
}
    $_SESSION["dossier"]=  serialize($dossier);
    include("../vue/dossier.php");
    

    if($_SESSION["user"]==="gestionnaire" && ($dossier->getVerification()==="en cours" || $dossier->getVerification()===NULL)){
?>

    
        <div>
            <table id="avis">
                    <td id="positif"  onclick="location='avis.php?a=1'">
                        Accepter le dossier
                    </td>
                <td id="negatif" onclick="location='avis.php?a=0'">
                    Refuser le dossier
                </td>
            </table>
        </div>
        
        <?php
    }
        ?>
    </body>
</html>
