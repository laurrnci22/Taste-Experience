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
$ListesIng = $gdb->getListesIngredients();
$ingredient = $gdb->getIngredient();
$Listescategorie = $gdb->getListescategorieRecettes();

ob_start();


if(isset($_POST['Id_recette'])){
    $_SESSION['idRecetteModif'] = $_POST['Id_recette'];

    $_SESSION['idRecetteRedirection'] = $_POST['Id_recette'];
    $recette = $gdb->rechercheRecette($_POST['Id_recette']);
    $ingredients = $gdb->rechercheIngredientsRecette($_POST['Id_recette']);
    $recetteMemeCategories = $gdb->rechercheRecetteMemeCategories($_POST['Id_recette']);
    $tags = $gdb->rechercheTagsRecette($_POST['Id_recette']);

   $affiche->AfficherRecette($recette[0],$ingredients,$recetteMemeCategories,$tags);

}

else if(isset($_SESSION['idRecetteRedirection'])){

    $recette = $gdb->rechercheRecette($_SESSION['idRecetteRedirection']);
    $ingredients = $gdb->rechercheIngredientsRecette($_SESSION['idRecetteRedirection']);
    $recetteMemeCategories = $gdb->rechercheRecetteMemeCategories($_SESSION['idRecetteRedirection']);
    $tags = $gdb->rechercheTagsRecette($_SESSION['idRecetteRedirection']);

    $affiche->AfficherRecette($recette[0],$ingredients,$recetteMemeCategories,$tags);
}


$content = ob_get_clean();
Template::render($content, $title = "Ajout Donnees");
