<?php
session_start();
require_once "../../config.php";

require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();

use recette\Donnees;
$gdb = new Donnees();


//modification d un ingredient !
if(isset($_POST['Quantité']) && isset($_POST['Unite']) && isset($_POST['idIngredient']) && isset($_POST['idRecette'])){
    $idrec = (int)$_POST['idRecette'];
    $iding = (int)$_POST['idIngredient'];
    $qtte = htmlspecialchars($_POST['Quantité']);
    $unite = htmlspecialchars($_POST['Unite']);
    $gdb->modifListesIngredient($idrec , $iding,$qtte,$unite);
}

//ajout des caracteristiques d'un ingredient deja existant !
if(isset($_POST['choixIngredients']) && isset($_POST['Quantite']) && isset($_POST['unite']) && isset($_POST['idRecette'])){
    $idrec = (int)$_POST['idRecette'];
    $iding = (int)$_POST['choixIngredients'];
    $qtte = htmlspecialchars($_POST['Quantité']);
    $unite = htmlspecialchars($_POST['Unite']);
    $gdb->modifListesIngredient($idrec , $iding,$qtte,$unite);
}
header("Location:".$GLOBALS['AFFICHAGES']."afficheRecette.php");
exit();







