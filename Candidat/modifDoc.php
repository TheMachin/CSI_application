<?php
   include("../modele/connexion.php");
include("../vue/deconnexion.php");
include("../modele/CandidatSql.php");
include("../modele/GestionnaireSql.php");
include("../modele/DossierSql.php");
include("../modele/PaysSql.php");
include("../modele/CandidatureSql.php");
include("../modele/FormationSql.php");
include("../modele/ResponsableFSql.php");
include("../modele/UniversiteSql.php");
include("../modele/DocumentSql.php");
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

if(!empty($_POST))
{
    if(!empty($_POST['curri']))
    {
        $curriculumVitaee = $pdo->query('SELECT doc.NO_DOC
                    FROM dossier dos, document doc, contient_document cd
                    WHERE doc.no_doc = cd.no_doc
                    AND cd.no_dossier = dos.no_dossier
                    AND doc.type_doc = "CV"
                    AND dos.NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
        $CVV = $curriculumVitaee->fetch();
       $reqq = $pdo->prepare('UPDATE document SET NOM_DOC = :nomdoc WHERE NO_DOC = :nodoc');
        $reqq->execute(array(
            'nomdoc' => $_POST['curri'],
            'nodoc' => $CVV['NO_DOC']
            ));
        echo 'Le CV a bien été modifié !';
    }
    
    if(!empty($_POST['nLDM']))
    {
        $dos = $pdo->query('SELECT NO_DOSSIER
        FROM dossier
        WHERE NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
        $doss = $dos->fetch();
        
        $req = $pdo->prepare('INSERT INTO document(NOM_DOC, TYPE_DOC) VALUES(:NOM_DOC, :TYPE_DOC)');
        $req->execute(array(
            'NOM_DOC' => $_POST['nLDM'],
            'TYPE_DOC' => "Lettre de motivation"
        ));
        
        $doc = $pdo->query('SELECT NO_DOC
        FROM document
        WHERE type_doc = "Lettre de motivation"
        ORDER BY NO_DOC DESC LIMIT 0, 1');
        $docc = $doc->fetch();
        
        $req2 = $pdo->prepare('INSERT INTO contient_document(NO_DOC, NO_DOSSIER) VALUES(:NO_DOC, :NO_DOSSIER)');
        $req2->execute(array(
            'NO_DOC' => $docc['NO_DOC'],
            'NO_DOSSIER' => $doss['NO_DOSSIER']
        ));
        $var = 'La nouvelle lettre de motivation a bien ete ajoutee';
    }
    
    if(!empty($_POST['nJDD']))
    {
        $dos = $pdo->query('SELECT NO_DOSSIER
        FROM dossier
        WHERE NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
        $doss = $dos->fetch();
        
    
        $req = $pdo->prepare('INSERT INTO document(NOM_DOC, TYPE_DOC) VALUES(:NOM_DOC, :TYPE_DOC)');
        $req->execute(array(
            'NOM_DOC' => $_POST['nJDD'],
            'TYPE_DOC' => "Justificatif de diplôme"
        ));
        
        $doc = $pdo->query('SELECT NO_DOC
        FROM document
        WHERE type_doc = "Justificatif de diplôme"
        ORDER BY NO_DOC DESC LIMIT 0, 1');
        $docc = $doc->fetch();
        
        $req2 = $pdo->prepare('INSERT INTO contient_document(NO_DOC, NO_DOSSIER) VALUES(:NO_DOC, :NO_DOSSIER)');
        $req2->execute(array(
            'NO_DOC' => $docc['NO_DOC'],
            'NO_DOSSIER' => $doss['NO_DOSSIER']
        ));
        $var = 'Le nouveau justificatif de diplome a bien ete ajoutee';
    }
    
    if(!empty($_POST['nRDN']))
    {
        $dos = $pdo->query('SELECT NO_DOSSIER
        FROM dossier
        WHERE NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
        $doss = $dos->fetch();
    
        $req = $pdo->prepare('INSERT INTO document(NOM_DOC, TYPE_DOC) VALUES(:NOM_DOC, :TYPE_DOC)');
        $req->execute(array(
            'NOM_DOC' => $_POST['nRDN'],
            'TYPE_DOC' => "Relevé de note"
        ));
        
        $doc = $pdo->query('SELECT NO_DOC
        FROM document
        WHERE type_doc = "Relevé de note"
        ORDER BY NO_DOC DESC LIMIT 0, 1');
        $docc = $doc->fetch();
        
        $req2 = $pdo->prepare('INSERT INTO contient_document(NO_DOC, NO_DOSSIER) VALUES(:NO_DOC, :NO_DOSSIER)');
        $req2->execute(array(
            'NO_DOC' => $docc['NO_DOC'],
            'NO_DOSSIER' => $doss['NO_DOSSIER']
        ));
        $var = 'Le nouveau relevé de notes a bien ete ajoutee';
    }
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Modification des documents</title>
    </head>
    <body>
        <?php if(!empty($var))
        {
           echo '<p>'.$var.'</p>'; 
        } ?>
        <h2>CV déposé :</h2>
        <form action="modifDoc.php" method="post" >
            <p>
                <?php
                    $curriculumVitae = $pdo->query('SELECT doc.NOM_DOC
                    FROM dossier dos, document doc, contient_document cd
                    WHERE doc.no_doc = cd.no_doc
                    AND cd.no_dossier = dos.no_dossier
                    AND doc.type_doc = "CV"
                    AND dos.NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
                    $CV = $curriculumVitae->fetch();
                    echo '<input type="text" name="curri" value="'. $CV['NOM_DOC'] . '" />';
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
        <form action="modifDoc.php" method="post" >
            <p>
                <label>Nouvelle lettre de motivation :</label>
                <input type="text" name="nLDM" />
                <input type="submit" value="Ajouter"/>
            </p>
        </form>
        <h2>Liste des justificatifs de diplôme :</h2>
            <table>
                <tbody>
                    <?php
                        $justificatifDiplome = $pdo->query('SELECT doc.NOM_DOC
                        FROM dossier dos, document doc, contient_document cd
                        WHERE doc.no_doc = cd.no_doc
                        AND cd.no_dossier = dos.no_dossier
                        AND doc.type_doc = "Justificatif de diplôme"
                        AND dos.NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
                        while ($jD = $justificatifDiplome->fetch())
                        {
                            echo '<tr>';
                            echo '<td>'. $jD['NOM_DOC']. '</td>';
                            echo '</tr>';
                            //echo '<input type="text" name="justificatif" value="'. $jD['NOM_DOC'] . '" />';
                            //echo '<input type="submit" value="Modifier"/>';
                        }
                    ?>
                </tbody>
            </table>
            <form action="modifDoc.php" method="post" >
                <p>
                    <label>Nouveau justificatif de diplôme :</label>
                    <input type="text" name="nJDD" />
                    <input type="submit" value="Ajouter"/>
                </p>
            </form>
        <h2>Liste des relevés de notes :</h2>
            <table>
                <tbody>
                    <?php
                        $releveNote = $pdo->query('SELECT doc.NOM_DOC
                        FROM dossier dos, document doc, contient_document cd
                        WHERE doc.no_doc = cd.no_doc
                        AND cd.no_dossier = dos.no_dossier
                        AND doc.type_doc = "Relevé de note"
                        AND dos.NOM_CANDIDAT =\''. $candidat->getNom_candidat().'\'');
                        while ($rN = $releveNote->fetch())
                        {
                            echo '<tr>';
                            echo '<td>'. $rN['NOM_DOC']. '</td>';
                            echo '</tr>';
                            //echo '<input type="text" name="releve" value="'. $rN['NOM_DOC'] . '" />';
                            //echo '<input type="submit" value="Modifier"/>';
                        }
                    ?>
                </tbody>
            </table>
            <form action="modifDoc.php" method="post" >
                <p>
                    <label>Nouveau relevé de notes :</label>
                    <input type="text" name="nRDN" />
                    <input type="submit" value="Ajouter"/>
                </p>
            </form>
        <a href="index.php">Retour</a>
    </body>
</html>