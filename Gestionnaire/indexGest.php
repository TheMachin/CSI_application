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

session_start();

if(empty($_SESSION["gestionnaire"]))
{
    header('Location: connexion.php');   
}else{
    $gestionnaire=  unserialize($_SESSION["gestionnaire"]);
}

if(empty($_SESSION["type"]))
{
      $_SESSION["type"]="gestionnaire";
}

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
        <title>Accueil Gestionnaire</title>
    </head>
    <body>
        <?php
            echo '<p>Bonjour '. $gestionnaire->getPrenom(). ' '. $gestionnaire->getNom() .' !</p>';
        ?>
    </body>
</html>
