<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<table>
    <thead>
        <tr>
            <th>Nom document</th>
            <th>Type document</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tabD=$dossier->getTabD();
            for($i=0;$i<count($tabD);$i++)
            {
                $doc=$tabD[$i];
                ?>
                    <tr>
                        <td><?php echo $doc->getNom(); ?></td>
                        <td><?php echo $doc->getType(); ?></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>