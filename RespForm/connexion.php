<?php
    session_start();
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
        <title>Espace Responsable de formation</title>
    </head>
    <body>
        <h1>
            Espace Responsable de formation - Connexion
        </h1>
        <div id="msgE">
            <?php
                if(!empty($_SESSION["msgErreur"]))
                {
                    echo $_SESSION["msgErreur"];
                    unset($_SESSION["msgErreur"]);
                    session_destroy();
                }
            ?>
        </div>
        <form action="../Connexion/checkConnexion.php" method="post" >
            <div class="form-group">
                <label for="user">Nom d'utilisateur : </label>
                <input type="text" id="user" name="user" placeholder="Nom d'utilisateur" class="form-control">
            </div>
            <div class="form-group">
                <label for="pwd">Mot de passe :</label>
                <input type="password" id="pwd" name="pwd" placeholder="Mot de passe" class="form-control">
                <input type="hidden" id="type" name="type" value="responsable">
            </div>
            <div>
		<input type="submit" id="valider" name="valider" value="Valider" class="btn btn-success">
            </div>
        </form>
    </body>
</html>

