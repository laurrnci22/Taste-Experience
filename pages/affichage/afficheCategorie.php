<?php
session_start();
require_once "../../config.php";

require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();

use recette\Template;
use recette\Affichages;
use recette\Donnees;

$gdb = new Donnees() ;
$affiche = new Affichages();
$recettes = $gdb->getRecettes();
$Listescategorie = $gdb->getListescategorieRecettes();
$categories = $gdb->getcategorieRecettes();

ob_start();

if(isset($_POST['Id_categorie'])){
    $affiche->AfficherParCategorie($_POST['Id_categorie'],$Listescategorie,$categories,$recettes);
}
else{
    header("Location: ".$GLOBALS['DOCUMENT_DIR']."index.php");
    exit() ;
}


$content = ob_get_clean();
Template::render($content, $title = "Ajout Donnees");
