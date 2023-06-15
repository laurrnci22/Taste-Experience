<?php
session_start();
require_once "../../config.php";
require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();

use recette\Donnees;
$gdb = new Donnees();


if(isset($_POST['idRecette']) && isset($_POST['description'])){
    $desc = htmlspecialchars($_POST['description']);
    $id = (int)$_POST['idRecette'];
    $gdb->modifDescriptionRecette($id , $desc);
    $_SESSION['idRecetteRedirection'] = $_POST['idRecette'];

}
else{
    header("Location: ".$GLOBALS['DOCUMENT_DIR']."index.php");
    exit();
}
header("Location:".$GLOBALS['AFFICHAGES']."afficheRecette.php");
exit();

