<?php
   include("../modele/connexion.php");

include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/DossierSql.php");
include("../modele/PaysSql.php");
include("../modele/CandidatureSql.php");
include("../modele/FormationSql.php");
include("../modele/ResponsableFSql.php");
include("../modele/UniversiteSql.php");

session_start(); 
if(empty($_SESSION["dossier"]) && empty($_GET["noDossier"]))
{
    if(!empty($_SESSION["candidat"]))
    {
        $candidat=  unserialize($_SESSION["candidat"]);
        $dossierSql=new DossierSql();
        $dossier=$dossierSql->getDossierDuCandidat($pdo, $candidat);
    }else{
        exit;
    }
}else if(!empty($_SESSION["dossier"])){
    $dossier=  unserialize($_SESSION["dossier"]);
    $candidat=$dossier->getCandidat();
}else if(!empty($_GET["noDossier"])){
    $dossierSql=new DossierSql();
    $dossier=$dossierSql->getDossierById($pdo, $_GET["noDossier"]);
}


$candidatureSql=new CandidatureSql();
$tabCanditure=$candidatureSql->getCandidatureByUser($pdo, $candidat->getNom_candidat());
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Modification des documents</title>
    </head>
    <body>
        <h2>CV déposé :</h2>
        <form action="index.php" method="post" >
            <p>
                <?php
                    $curriculumVitae = $pdo->query('SELECT doc.NOM_DOC
                    FROM dossier dos, document doc, contient_document cd
                    WHERE doc.no_doc = cd.no_doc
                    AND cd.no_dossier = dos.no_dossier
                    AND doc.type_doc = "CV"
                    AND dos.NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
                    $CV = $curriculumVitae->fetch();
                    echo '<input type="text" name="ldm" value="'. $CV['NOM_DOC'] . '" />';
                ?>
                <input type="submit" value="Modifier"/>
            </p>
        </form>
        <h2>Liste des lettres de motivation :</h2>
        <?php
            $motivation = $pdo->query('SELECT doc.NOM_DOC
            FROM dossier dos, document doc, contient_document cd
            WHERE doc.no_doc = cd.no_doc
            AND cd.no_dossier = dos.no_dossier
            AND doc.type_doc = "Lettre de motivation"
            AND dos.NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
            echo $candidat->getNom_candidat();
        ?>
        <table>
            <tbody>
                <?php
                    while ($lettre = $motivation->fetch()) {
                        echo '<tr>';
                        echo '<td>'. $lettre['NOM_DOC']. '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
        <h2>Liste des justificatifs de diplôme</h2>
            <form action="index.php" method="post" >
                <p>
                    <?php
                        $justificatifDiplome = $pdo->query('SELECT doc.NOM_DOC
                        FROM dossier dos, document doc, contient_document cd
                        WHERE doc.no_doc = cd.no_doc
                        AND cd.no_dossier = dos.no_dossier
                        AND doc.type_doc = "Justificatif de diplôme"
                        AND dos.NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
                        while ($jD = $justificatifDiplome->fetch())
                        {
                            echo '<input type="text" name="jD" value="'. $jD['NOM_DOC'] . '" />';
                            echo '<input type="submit" value="Modifier"/>';
                        }
                    ?>
                </p>
            </form>
    </body>
</html>