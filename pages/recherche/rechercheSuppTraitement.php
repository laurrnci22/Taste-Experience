<?php
require_once "../../config.php";
session_start();

require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use recette\Donnees;


$recette = new Donnees();


if(isset($_POST['fname']) ){
    $termes = htmlspecialchars($_POST['fname'] );
    //var_dump($termes);
    $recherche = $recette->rechercheTerme($termes);
    $_SESSION['rechercheSuppRecette'] = $recherche;
    header("Location:".$GLOBALS['SUPPRESSION']."retirerRecette.php");
    exit();
}