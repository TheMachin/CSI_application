<?php 
header('Content-Type: text/html; charset=utf-8');

$hostname="localhost";
$database="csi";
$username="root";
$password_connexion="";
$pdo=NULL;
try{
    $pdo = new PDO("mysql:host=".$hostname.";dbname=".$database,$username,$password_connexion);
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(PDOException $e)
{
    $pdo=NULL;
    echo "echec connexion PDO : ".$e;
}
    ?> 