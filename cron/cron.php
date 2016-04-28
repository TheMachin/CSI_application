<?php

/*
 * Script exécuté tous les 2 jours.
 */

include("../modele/connexion.php");
include("../modele/CandidatureSql.php");

$candidatureSql=new CandidatureSql();

/*
 * On appelle une procédure pour refuser les candidatures dont la date limite est dépassé
 */
$candidatureSql->callProcedureSiDateDepasse($pdo);

/*
 * On appelle une procédure pour récupérer les candidatures dont il reste 3 jours avant la date limite
 */
$tabR=$candidatureSql->callProcedureRappel($pdo);

/*
 * Si l'était d'une candidature est "en cours", le gestionnaire a 30 jours pour donner son avis
 * Si l'était d'une candidature est "accepté", le candidat a 10 jours pour donner son avis
 */
foreach ($tabR as $value) {
    if($value[1]==="en cours")
    {
        /*
         * on récupère le dossier du candidat et la formation.
         * Puis on envoie un mail au gestionnaire la liste des candidatures en attente.
         */
    }else if($value[1]==="accepté"){
        /*
         * On récupère son dossier et on lui envoie un mail 
         */
    }
}
