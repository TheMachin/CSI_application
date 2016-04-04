<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Espace Candidat</title>
    </head>
    <body>
        <h1>
            Espace Candidat - Connexion
        </h1>
        
        <h3>
            Pas encore inscrit ? <a href="inscription.php" >Cliquez sur ce lien </a>
        </h3>
        
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

