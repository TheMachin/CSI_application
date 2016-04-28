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

//recupere nom formation
$form = $pdo->query('select * from formation');
//recupere nb candidature par formation
$nbCand = $pdo->query('select count(c.NO_CANDIDATURE)as nb from formation f, candidature c where c.NO_FORMATION=f.NO_FORMATION');


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
        <title>Statistique</title>
    </head>
    <body>
        <h1>
            Statistique
        </h1>
        <TABLE BORDER="1"> 
            <CAPTION> Candidatures par formation </CAPTION>
            <TR>
                <TH> Universite </TH>
                <?php while($donneesForm = $form->fetch())
                    echo '<th>' . $donneesForm['NOM_FORMATION'] . '</th>'; 
                ?>
            </TR> 
            <TR> 
                <TH> Nombre de candidatures </TH> 
                <?php while($donneesnbCand = $nbCand->fetch())
                    echo '<td>' . $donneesnbCand['nb'] . '</td>';
                ?>
            </TR>
        </TABLE>
        
        <?php
        //recupere nom pays
        $pays = $pdo->query('select * from pays');
        //recupere nb candidat par pays
        $nbCandidat = $pdo->query('select count(c.NOM_CANDIDAT)as candidat, p.NOM_PAYS from pays p, candidat c where p.NO_PAYS=c.NO_PAYS group by p.NOM_PAYS');
        ?>
        
        <TABLE BORDER="1"> 
            <CAPTION> Candidats par pays </CAPTION>
            <TR>
                <TH> Pays </TH>
                <?php while($donneesPays = $pays->fetch())
                    echo '<th>' . $donneesPays['NOM_PAYS'] . '</th>'; 
                ?>
            </TR> 
            <TR> 
                <TH> Nombre de candidats </TH> 
                <?php while($donneesnbC = $nbCandidat->fetch())
                    echo '<td>' . $donneesnbC['candidat'] . '</td>';
                ?>
            </TR>
        </TABLE>
    </body>
</html>
