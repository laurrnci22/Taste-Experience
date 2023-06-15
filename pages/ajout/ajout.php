<?php
session_start();
require_once "../../config.php";


if(!isset($_SESSION['username'])){
    header("Location:".$GLOBALS['DOCUMENT_DIR']."pages/login.php");
    exit();
}

require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use recette\Template;
use recette\Formulaires;
use recette\Affichages;
use recette\Donnees;

ob_start() ;
$formajout = new Formulaires();
$affichage = new Affichages();
$gdb = new Donnees();


if(isset($_SESSION['validation']) && !$_SESSION['validation'] ){
    $affichage->AfficherErreur();
}

$_SESSION['Categories'] = $gdb->getcategorieRecettes();//stockage de toutes les categories !
$_SESSION['Ingredients'] = $gdb->getIngredient();
$_SESSION['Tags'] = $gdb->getTag();

$formajout->AjoutForm();
$content = ob_get_clean();

Template::render($content, $title = "Ajout Donnees");
