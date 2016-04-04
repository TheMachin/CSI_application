<?php
include "../modele/connexion.php";
include "../modele/CandidatSql.php";
include "../modele/PaysSql.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$candidatTab=NULL;
$candidatSql=new CandidatSql();
$candidatTab=$candidatSql->getAll($pdo);


?>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Pays</th>
            <th>Date de naissance</th>
            <th>Téléphone</th>
            <th>Courriel</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($candidatTab as $candidat)
            {
                ?>
                    <tr>
                        <td><?php echo $candidat->getNom(); ?></td>
                        <td><?php echo $candidat->getPrenom(); ?></td>
                        <td><?php echo $candidat->getPays()->getNom_pays();?> </td>
                        <td><?php echo $candidat->getDate_nais(); ?></td>
                        <td><?php echo $candidat->getTelephone(); ?></td>
                        <td><?php echo $candidat->getEmail(); ?></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>