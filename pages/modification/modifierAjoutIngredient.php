<?php
session_start();
require_once "../../config.php";

require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();

use recette\Donnees;

$gdb = new Donnees();


if(isset($_POST['choixIngredients'])){
    $ID_ingredient = $_POST['choixIngredients'];
    $ID_recette = $_POST['idRecette'];
    $mesure = $_POST['Unite'];
    $qte = $_POST['Quantite'];

    $gdb->ajoutIngredientRecette($ID_ingredient, $ID_recette, $qte, $mesure);
    $_SESSION['idRecetteRedirection'] = $_POST['idRecette'];
}
header("Location:".$GLOBALS['AFFICHAGES']."afficheRecette.php");
exit();
