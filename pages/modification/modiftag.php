<?php
session_start();
require_once "../../config.php";


require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();

use recette\Donnees;

$gdb = new Donnees();
$listesTags = $gdb->getTag();
$allListesTags  = $gdb->getListestag();


if(isset($_POST['tag']) && isset($_POST['idRecette'])) {
    $idRecette = htmlspecialchars($_POST['idRecette']); // id de la recette

    $tagsModifs = htmlspecialchars($_POST['tag']);
    $tagsModifs = trim($tagsModifs); // retirer les espaces
    $tableTabs = explode(" ", $tagsModifs); // decompose les mots en tableaux
    $tableTabs = array_unique($tableTabs); // recupere les mots uniques


    $recettesTags = $gdb->rechercheTagsRecette($idRecette) ;

    //supprimer les recettes de la BD
    foreach ($recettesTags as $tag){
            $gdb->SupprimerTag($tag->ID_tag, $idRecette);
    }

    // Ajoute les tags qui n'existent pas dans la BD
    foreach ($tableTabs as $tag)
        if ($gdb->rechercheIDTag($tag) == null)
            $gdb->ajoutTag($tag);


    // inserer les tags associent a la recette
    foreach ($tableTabs as $tag) {
        $idTag = $gdb->rechercheIDTag($tag);
        $gdb->ajoutTagRecette($idTag[0]->ID_tag , $idRecette);
    }
    $_SESSION['idRecetteRedirection'] = $idRecette;

}
header("Location:".$GLOBALS['AFFICHAGES']."afficheRecette.php");
exit();

