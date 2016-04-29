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
            <?php 
            if($_SESSION["user"]!=="candidat")
            {
                ?>
                    <th>Nom candidat</th>
                    <th>Prénom candidat</th>
                <?php
            }
            ?>
            <th>Formation</th>
            <th>Niveau formation</th>
            <th>Domaine</th>
            <th>Université</th>
            <th>Ville</th>
            <th>Etat candidature</th>
            
            <?php 
            if($_SESSION["user"]!=="candidat")
            {
                ?>
                    <th>Dossier</th>
                    <?php if($_SESSION["user"]!=="gestionnaire"){ ?>
                        <th>Accepter</th>
                    <?php } ?>
                    <th>Refuser</th>
                <?php
            }else{
                echo "<th>Action</th>";
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($tabCanditure as $candidature)
            {
               ?>
                <tr>
                    <?php 
                    if($_SESSION["user"]!=="candidat")
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
                    <td><?php echo $candidature->getFormation()->getUniversite()->getNom_univ(); ?></td>
                    <td><?php echo $candidature->getFormation()->getUniversite()->getVille(); ?></td>
                    <td><?php echo $candidature->getVerificaion(); ?></td>
                    <?php 
                    if($_SESSION["user"]!=="candidat")
                    {
                        ?>
                        <td><a href="../Dossier/index.php?noDossier=<?php echo $dossier->getNo(); ?>">acceder</a></td>
                        <?php 
                        if($_SESSION["user"]!=="gestionnaire" ){ 
                                if($candidature->getVerificaion()!="accepté" && $candidature->getVerificaion()!="refusé" && $candidature->getVerificaion()!="annulé")
                                {
                            ?>
                                    <td><a href="../Candidature/avis.php?noCand=<?php echo $candidature->getNo(); ?>&avis=P">Accepter candidature</a></td>
                                    <td><a href="../Candidature/avis.php?noCand=<?php echo $candidature->getNo(); ?>&avis=R">Refuser candidature</a></td>
                        <?php
                                }else{
                                    ?>
                                    <td></td>
                                    <td></td>
                                    <?php
                                }
                        }else{
                            if($candidature->getVerificaion()==="accepté" || $candidature->getVerificaion()==="refusé" || $candidature->getVerificaion()==="annulé")
                            {
                                ?>
                                    <td></td>
                                <?php
                            }else{
                                ?>
                                    <td><a href="../Candidature/avis.php?noCand=<?php echo $candidature->getNo(); ?>&avis=R">Refuser candidature</a></td>
                                    <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    }else{
                        if($candidature->getVerificaion()!="accepté" && $candidature->getVerificaion()!="refusé" && $candidature->getVerificaion()!="annulé" && $candidature->getVerificaion()!="confirmé")
                                {
                            ?>
                                    <td><a href="../Candidature/avis.php?noCand=<?php echo $candidature->getNo(); ?>&avis=A">Annuler candidature</a></td>
                        <?php
                                }else{
                                    if($candidature->getVerificaion()==="accepté"){
                                        ?> <td><a href="../Candidature/avis.php?noCand=<?php echo $candidature->getNo(); ?>&avis=C">Confirmer candidature</a></td> <?php 
                                    }else{ 
                                            echo "<td></td>";
                                    }
                                }
                    }
            }
}else{
    echo "Aucune candidature";
} 
                ?>
    </tbody>
</table>

