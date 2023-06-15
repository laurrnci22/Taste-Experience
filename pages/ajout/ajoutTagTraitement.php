<?php
session_start();
require_once "../../config.php";

if(isset($_POST['nom-categorie'])){

    if(!isset($_SESSION['nom-categorie']))   $_SESSION['nom-categorie'] = array();
    $data = array(
        'nom' =>$_POST['nom-categorie']
    );
    array_push( $_SESSION['nom-categorie'], $data);

}
else{
    header("Location:".$GLOBALS['DOCUMENT_DIR']."index.php");
    exit();

}
header("Location:".$GLOBALS['PAGES']."ajout.php");
exit();
