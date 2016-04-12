<!DOCTYPE html>
<?php
    include("../modele/connexion.php"); 
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
                WHERE f.NO_UNIV = u.NO_UNIV');
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
                        echo '<td><a href="candidater.php?ajout='. $donnees['NOM_UNIV'] . '>Ajouter</a></td>';
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