<?php
include "../modele/connexion.php";
include "../modele/CandidatSql.php";
include "../modele/PaysSql.php";
include "../modele/DossierSql.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$candidatTab=NULL;
$candidatSql=new CandidatSql();
$candidatTab=$candidatSql->getAll($pdo);
$dossierSql=new DossierSql();
foreach ($candidatTab as $candidat) {
    $tabDossier[]=$dossierSql->getDossierDuCandidat($pdo, $candidat->getNom_candidat());
}

?>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Pays</th>
            <th>Dossier</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($i=0;$i<count($candidatTab);$i++)
            {
                $candidat=$candidatTab[$i];
                ?>
                    <tr>
                        <td><?php echo $candidat->getNom(); ?></td>
                        <td><?php echo $candidat->getPrenom(); ?></td>
                        <td><?php echo $candidat->getPays()->getNom_pays();?> </td>
                        <td><a href="../Dossier/index.php?noDossier=<?php echo $tabDossier[$i]->getNo(); ?>">acceder au dossier</a></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>