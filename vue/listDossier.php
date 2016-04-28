<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if(!empty($TabDossier)){
 ?>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Pays</th>
            <th>Dossier</th>
            <th>Etat dossier</th>
            <th>Nombre de candidature</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($i=0;$i<count($TabDossier);$i++)
            {
                $dossier=$TabDossier[$i];
                $candidat=$dossier->getCandidat();
                $TabCandidature=$dossier->getTabCandidature();
                ?>
                    <tr>
                        <td><?php echo $candidat->getNom(); ?></td>
                        <td><?php echo $candidat->getPrenom(); ?></td>
                        <td><?php echo $candidat->getPays()->getNom_pays();?> </td>
                        <td><a href="../Dossier/index.php?noDossier=<?php echo $dossier->getNo(); ?>">acceder au dossier</a></td>
                        <td><?php echo $dossier->getVerification(); ?></td>
                        <td><?php echo count($TabCandidature); ?></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>
<?php 
}