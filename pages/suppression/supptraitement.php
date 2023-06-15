<?php
session_start();
require_once "../../config.php";

require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();
use recette\Donnees;

$gdb = new Donnees();

if(isset($_POST['Id_recette'])){
    $gdb->supprimerRecette($_POST['Id_recette']);
    $gdb->miseAjourSupprimer();
}
else{
    header("Location:".$GLOBALS['DOCUMENT_DIR']."index.php");
    exit();
}
header("Location: ".$GLOBALS['DOCUMENT_DIR']."index.php");
exit();
