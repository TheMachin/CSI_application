<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Espace Gestionnaire</title>
    </head>
    <body>
        <h1>
            Espace Gestionnaire - Connexion
        </h1>
        <form action="checkConnexion.php" method="post" >
            <div class="form-group">
                <label for="user">Nom d'utilisateur : </label>
                <input type="text" id="pwd" name="user" placeholder="Nom d'utilisateur" class="form-control">
            </div>
            <div class="form-group">
                <label for="pwd">Mot de passe :</label>
                <input type="password" id="pwd" name="pwd" placeholder="Mot de passe" class="form-control">
            </div>
            <div>
		<input type="submit" id="valider" name="valider" value="Valider" class="btn btn-success">
            </div>
        </form>
    </body>
</html>

