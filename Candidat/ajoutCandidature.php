<?php
include("../vue/deconnexion.php");
   include("../modele/connexion.php");
include("../modele/DocumentSql.php");
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
        <title>Confirmation candidature</title>
    </head>
    <body>
        <h2>Vous allez postuler dans cette formation :</h2>
        <?php
            $reponse = $pdo->query('SELECT u.NOM_UNIV, f.NOM_FORMATION, f.DOMAINE, f.NIVEAU, f.DATE_LIMITE, f.NBRE_PLACE_LIMITE, f.NO_FORMATION
            FROM formation f, universite u
            WHERE f.NO_UNIV = u.NO_UNIV
            AND u.NOM_UNIV=\''. $_GET['ajout'] . '\'');
            while ($donnees = $reponse->fetch())
            {
                echo '<p>Nom de l\'université : '. $donnees['NOM_UNIV'] .'</p>';
                echo '<p>Nom de la formation : '. $donnees['NOM_FORMATION'] .'</p>';
                echo '<p>Domaine : '. $donnees['DOMAINE'] . '</p>';
                echo '<p>Niveau : '. $donnees['NIVEAU']. '</p>';
                echo '<p>Date limite : '. $donnees['DATE_LIMITE']. '</p>';
                echo '<p>Nombre de place limite : '. $donnees['NBRE_PLACE_LIMITE'].'</p>';
                $noForm = $donnees['NO_FORMATION'];
            }
        ?>
        <h3>Choisissez une lettre de motivation :</h3>
        <?php
            $motivation = $pdo->query('SELECT doc.NOM_DOC, doc.NO_DOC
            FROM dossier dos, document doc, contient_document cd
            WHERE doc.no_doc = cd.no_doc
            AND cd.no_dossier = dos.no_dossier
            AND doc.type_doc = "Lettre de motivation"
            AND dos.NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
        ?>
        <table>
            <tbody>
                <?php
                    while ($lettre = $motivation->fetch()) {
                        echo '<tr>';
                        echo '<td>'. $lettre['NOM_DOC']. '</td>';
                        echo '<td>
                        <form action="index.php" method="post" >
                        <input type="hidden" name="no_form" value="'. $noForm . '" />
                        <input type="hidden" name="no_lettre" value="'. $lettre['NO_DOC'] . '" />
                        <input type="submit" value="Confirmer"/>
                        </form>
                        </td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
        <form action="index.php" method="post" >
            <p>
                <label>Nouvelle lettre de motivation :</label>
                <input type="text" name="ldm" />
                <?php
                echo '<input type="hidden" name="no_form" value="'. $noForm . '" />'; ?>
                <input type="submit" value="Confirmer"/>
            </p>
        </form>
    </body>
</html>