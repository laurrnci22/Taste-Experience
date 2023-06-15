<?php
require_once "../../config.php";
session_start();

require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use recette\Donnees;

$recette = new Donnees();

if(isset($_POST['fname']) ) {


    $mots = trim($_POST['fname']);
    $tabMots = explode(" ", $mots);// Pour séparer si c'etait une phrase !! et rechercher mot par mot

    if(isset($_SESSION['username'])){

        $_SESSION['search'] = "ok";//pour afficher les filtres

        foreach ($tabMots as $mot) {
            $termes = htmlspecialchars($mot);
            $recherche = $recette->rechercheIngredientTerme($termes);

            if (isset($_SESSION["checkedIngredient"])) {
                foreach ($recherche as $rch)
                    array_push($_SESSION["checkedIngredient"], $rch);
            }
            else
                $_SESSION["checkedIngredient"] = $recherche;
        }

        foreach ($tabMots as $mot) {
            $termes = htmlspecialchars($mot);
            $recherche = $recette->rechercheTagTerme($termes);

            if (isset( $_SESSION["checkedTag"])) {
                foreach ($recherche as $rch)
                    array_push( $_SESSION["checkedTag"], $rch);
            }
            else
                $_SESSION["checkedTag"] = $recherche;
        }
    }

    foreach ($tabMots as $mot) {
        $termes = htmlspecialchars($mot);
        $recherche = $recette->rechercheTerme($termes);

        if (isset($_SESSION['rechercheRecette'])) {
            foreach ($recherche as $rch)
                array_push($_SESSION['rechercheRecette'], $rch);
        }
        else
            $_SESSION['rechercheRecette'] = $recherche;
    }
}

else{
    header("Location:".$GLOBALS['DOCUMENT_DIR']."index.php");
    exit();
}

header("Location:".$_SERVER['HTTP_REFERER']);
exit();