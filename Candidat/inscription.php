<?php
include("../modele/connexion.php");
include("../modele/PaysSql.php");
include("../modele/DocumentSql.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

$paysSql=new PaysSql();
 
$tabPays=$paysSql->getAllPays($pdo);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription Candidat</title>
        <script>
            var i=1;
            function plus()
            {
                i++;
                var content = document.getElementById('listDoc').innerHTML;
                document.getElementById('listDoc').innerHTML = content+'<br><div><label for="tel">Nom du document '+i+' : </label><input type="text" id="document" name="document'+i+'" placeholder="Nom du document" class="form-control"><select id="listType" name="type'+i+'"><option value="diplome">Justificatif de diplôme</option><option value="note">Relevé de note</option></select></div>';
                document.getElementById("nbreDoc").value = i;
            } 
        </script>
    </head>
    <body>
        <h1>
            Espace Candidat - Inscription
        </h1>
        
        <h3>
            Déjà inscrit ? <a href="connexion.php" >Cliquez sur ce lien </a>
        </h3>
        <div id="msgE">
            <?php
                if(!empty($_SESSION["msgErreur"]))
                {
                    echo $_SESSION["msgErreur"];
                    unset($_SESSION["msgErreur"]);
                }
            ?>
        </div>
        <form action="traitInscription.php" method="post" >
            <div class="form-group">
                <label for="user">Nom d'utilisateur (qui sera utilisé pour se connecter) : </label>
                <input type="text" id="pwd" name="user" placeholder="Nom d'utilisateur" class="form-control">
            </div>
            <div class="form-group">
                <label for="pwd">Mot de passe :</label>
                <input type="password" id="pwd" name="pwd" placeholder="Mot de passe" class="form-control">
            </div>
            <div class="form-group">
                <label for="pwd2">Confirmer mot de passe :</label>
                <input type="password" id="pwd2" name="pwd2" placeholder="Mot de passe" class="form-control">
            </div>
            <div class="form-group">
                <label for="pays">Pays :</label>
                <select id="listPays" name="pays">
                    <?php
                    foreach ($tabPays as $pays) {
                        echo "<option value='".$pays->getId()."'>".$pays->getNom_pays()."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Nom" class="form-control">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" placeholder="prenom" class="form-control">
            </div>
            <div class="form-group">
                <label for="dateN">Date de naissance :</label>
                <input type="date" id="pwd2" name="dateN" placeholder="jj/mm/aaaa" class="form-control">
            </div>
            <div class="form-group">
                <label for="mail">Adresse mail : </label>
                <input type="text" id="pwd" name="email" placeholder="adresse@mail" class="form-control">
            </div>
            <div class="form-group">
                <label for="tel">Numéro de téléphone : </label>
                <input type="text" id="pwd" name="tel" placeholder="" class="form-control">
            </div>
            <br><br>
            <div class="doc">
                
                <div>
                        <label for="tel">Nom du CV : </label>
                        <input type="text" id="document" name="CV" placeholder="Nom du CV" class="form-control">
                </div>
                <br>
                <!--<div>
                        <label for="tel">Nom de la lettre de motivation : </label>
                        <input type="text" id="document" name="lettre" placeholder="Nom de la lettre de motivation" class="form-control">
                </div>-->
                <br>
                <input type="button" onclick="plus();" value="Cliquer ici pour ajouter un justificatif de diplôme ou un relévé de note">
                <input type="hidden" id="nbreDoc" name="nbreDoc" value="1">
                <div id="listDoc">
                    <div>
                        <label for="tel">Nom du document 1 : </label>
                        <input type="text" id="document" name="document1" placeholder="Nom du document" class="form-control">
                        <select id="listType" name="type1">
                            <option value="diplome">Justificatif de diplôme</option>
                            <option value="note">Relevé de note</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div>
		<input type="submit" id="valider" name="valider" value="Valider" class="btn btn-success">
            </div>
        </form>
    </body>
</html>