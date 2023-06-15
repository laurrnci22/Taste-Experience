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

ob_start();

if(isset($_POST['Id_ingredient'])) {
    $_SESSION['idIngredientModif'] = $_POST['Id_ingredient'];
    $id = (int)$_POST['Id_ingredient'];
   $ing = $gdb->rechercheIngredientavecId($id);
   $affiche->Afficheingredient($ing[0]);
}

else if(isset($_SESSION['idIngredientModif'])){
    $id = (int)$_SESSION['idIngredientModif'];
    $ing = $gdb->rechercheIngredientavecId($id);
    $affiche->Afficheingredient($ing[0]);
}

$content = ob_get_clean();
Template::render($content, $title = "Ajout Donnees");
