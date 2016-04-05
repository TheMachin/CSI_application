<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(count($tabCanditure)>0)
{
?>

<table>
    <thead>
        <tr>
            <th>Formation</th>
            <th>Niveau formation</th>
            <th>Domaine</th>
            <th>Université</th>
            <th>Ville</th>
            <th>Etat candidature</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($tabCanditure as $candidature)
            {
               ?>
                <tr>
<<<<<<< HEAD
                    <?php 
                    if($_SESSION["type"]!=="candidat")
                    {
                        $dossier=$candidature->getDossier();
                        $candidat=$dossier->getCandidat();
                        ?>
                            <td><?php echo $candidat->getNom(); ?></td>
                            <td><?php echo $candidat->getPrenom(); ?></td>
                        <?php
                    }
                    ?>
                    <td><?php echo $candidature->getFormation()->getNomFormation(); ?></td>
                    <td><?php echo $candidature->getFormation()->getNiveau(); ?></td>
                    <td><?php echo $candidature->getFormation()->getDomaine(); ?></td>
                    <td><?php echo $candidature->getUniversite()->getNom_univ(); ?></td>
                    <td><?php echo $candidature->getUniversite()->getVille(); ?></td>
                    <td><?php echo $candidature->getUniversite()->getVerificaion(); ?></td>
                    <?php 
                    if($_SESSION["type"]!=="candidat")
                    {
                        ?>
                    <td><a href="../Dossier/index.php?noDossier=<?php echo $dossier->getNo(); ?>">acceder</a></td>
                        <?php
                    }
                    ?>
=======
                    <th><?php echo $candidature->getFormation()->getNomFormation(); ?></th>
                    <th><?php echo $candidature->getFormation()->getNiveau(); ?></th>
                    <th><?php echo $candidature->getFormation()->getDomaine(); ?></th>
                    <th><?php echo $candidature->getUniversite()->getNom_univ(); ?></th>
                    <th><?php echo $candidature->getUniversite()->getVille(); ?></th>
                    <th><?php echo $candidature->getUniversite()->getVerificaion(); ?></th>
>>>>>>> origin/master
                </tr>
                <?php
            } 
                ?>
    </tbody>
</table>

<?php
}else{
    echo "Aucune candidature";
}
?>