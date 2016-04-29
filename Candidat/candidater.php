<!DOCTYPE html>
<?php
include("../vue/deconnexion.php");
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
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Ajouter une candidature</title>
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>Ajout d'une candidature</h1>
        <h2>Liste des formations :</h2>
        <table>
            <?php
                $reponse = $pdo->query('SELECT u.NOM_UNIV, f.NOM_FORMATION, f.DOMAINE, f.NIVEAU, f.DATE_LIMITE, f.NBRE_PLACE_LIMITE
                FROM formation f, universite u
                WHERE f.NO_UNIV = u.NO_UNIV
                AND f.NO_FORMATION NOT IN (
                    SELECT f.NO_FORMATION
                    FROM formation f, candidature c, dossier d
                    WHERE f.NO_FORMATION = c.NO_FORMATION
                    AND d.NO_DOSSIER = c.NO_DOSSIER
                    AND d.NOM_CANDIDAT = \''.$candidat->getNom_candidat().'\')');
            ?>
            <thead>
                <tr>
                    <th>Nom de l'université</th>
                    <th>Nom de la formation</th>
                    <th>Domaine</th>
                    <th>Niveau</th>
                    <th>Date limite</th>
                    <th>Nombre de place limite</th>
                    <th>Ajout</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($donnees = $reponse->fetch())
                    {
                        echo '<tr>';
                        echo '<td>'. $donnees['NOM_UNIV'] . '</td>';
                        echo '<td>'. $donnees['NOM_FORMATION'] . '</td>';
                        echo '<td>'. $donnees['DOMAINE'] . '</td>';
                        echo '<td>'. $donnees['NIVEAU'] . '</td>';
                        echo '<td>'. $donnees['DATE_LIMITE'] . '</td>';
                        echo '<td>'. $donnees['NBRE_PLACE_LIMITE'] . '</td>';
                        echo '<td><a href="ajoutCandidature.php?ajout='. $donnees['NOM_UNIV'] . '">Ajouter</a></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
        <?php
            
        ?>
        </form>
    </body>
</html>