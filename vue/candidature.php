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
                    <th><?php echo $candidature->getFormation()->getNomFormation(); ?></th>
                    <th><?php echo $candidature->getFormation()->getNiveau(); ?></th>
                    <th><?php echo $candidature->getFormation()->getDomaine(); ?></th>
                    <th><?php echo $candidature->getUniversite()->getNom_univ(); ?></th>
                    <th><?php echo $candidature->getUniversite()->getVille(); ?></th>
                    <th><?php echo $candidature->getUniversite()->getVerificaion(); ?></th>
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