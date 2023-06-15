<?php
session_start();
require_once "../../config.php";


require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use recette\Affichages;

$affichage = new Affichages();

if(isset($_SESSION['recette']) && isset($_SESSION['listeIngredients']) && isset($_SESSION['nom-categorie'])) {
    $affichage->AfficheDonneesTest(  $_SESSION['recette'],$_SESSION['listeIngredients'],$_SESSION['nom-categorie']);
}
else{
    $_SESSION['validation'] = false;
    header("Location:".$GLOBALS['AJOUT']."ajout.php");
    exit();
}