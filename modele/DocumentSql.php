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
            $doc=new Document($row["NO_DOC"], $row["NOM_DOC"], $row["TYPE_DOC"]);
            array_push($tabD, $doc);
        }
        return $tabD;
    }
    
    function insertDocument($pdo,Dossier $d)
    {
        $tabD=$d->getTabD();
        foreach ($tabD as $doc) {
            try{
                $stmt = $pdo->prepare("INSERT INTO DOCUMENT (NOM_DOC,TYPE_DOC) VALUE (?,?)");
                $stmt -> bindValue(1,$doc->getNom());
                $stmt -> bindValue(2,$doc->getType());
                $stmt->execute();
                $id=$pdo->lastInsertId();
                $stmt = $pdo->prepare("INSERT INTO CONTIENT_DOCUMENT (NO_DOC,NO_DOSSIER) VALUE (?,?)");
                $stmt -> bindValue(1,$id);
                $stmt -> bindValue(2,$d->getNo());
                $stmt->execute();
                
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        
        
    }
    
    
}
