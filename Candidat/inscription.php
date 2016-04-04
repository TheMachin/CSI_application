<?php
include("../modele/connexion.php");
include("../modele/PaysSql.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$paysSql=new PaysSql();
 
$tabPays=$paysSql->getAllPays($pdo);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription Candidat</title>
    </head>
    <body>
        <h1>
            Espace Candidat - Inscription
        </h1>
        
        <h3>
            Déjà inscrit ? <a href="connexion.php" >Cliquez sur ce lien </a>
        </h3>
        
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
            
            <div class="doc">
                
            </div>
            
            <div>
		<input type="submit" id="valider" name="valider" value="Valider" class="btn btn-success">
            </div>
        </form>
    </body>
</html>