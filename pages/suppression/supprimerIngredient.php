<?php
session_start();
require_once "../../config.php";

require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();

use recette\Donnees;

$gdb = new Donnees();

$idIngredient = $_POST['Id_ingedient'][0];
$idRecette = $_POST['Id_recette'];

$gdb->supprimerIngredientRecette($idIngredient, $idRecette);

$gdb->miseAjourSupprimer();
//header("Location: " . $GLOBALS['DOCUMENT_DIR'] . "index.php");
header("Location:".$_SERVER['HTTP_REFERER']);

exit();
