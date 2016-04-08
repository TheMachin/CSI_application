<?php
include("Document.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentSql
 *
 * @author machin
 */
class DocumentSql {
    //put your code here
    function getAllDocumentByDossier($pdo,Dossier $d)
    {
        $tabD=array();
        $dossier=NULL;
        $req = $pdo->prepare("SELECT d.NO_DOC,NOM_DOC,TYPE_DOC FROM DOCUMENT d, CONTIENT_DOCUMENT c WHERE c.NO_DOC=d.NO_DOC AND NO_DOSSIER=?");
        $req->bindValue(1,$d->getNo());
        $req->execute();
        foreach ($req as $row) {
            $doc=new Document($no, $nom, $type);
            array_push($tabD, $doc);
        }
        return $tabD;
    }
    
    function insertDocument($pdo,Dossier $d)
    {
        $tabD=$d->getTabD();
        
        
    }
    
    
}
