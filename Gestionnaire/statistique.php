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

//recupere nom universite
$univ = $pdo->query('select * from universite');
//recupere nb candidature par universite
$nbCand = $pdo->query('select count(NO_CANDIDATURE)as nb from universite, candidature where NO_FORMATION=NO_UNIV');


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
            <CAPTION> Candidatures par universite </CAPTION>
            <TR>
                <TH> Universite </TH>
                <?php while($donneesUniv = $univ->fetch())
                    echo '<th>' . $donneesUniv['NOM_UNIV'] . '</th>'; 
                ?>
            </TR> 
            <TR> 
                <TH> Nombre de candidature </TH> 
                <?php while($donneesnbCand = $nbCand->fetch())
                    echo '<td>' . $donneesnbCand['nb'] . '</td>';
                ?>
            </TR>
        </TABLE>
        <?php
          
        ?>
    </body>
</html>
