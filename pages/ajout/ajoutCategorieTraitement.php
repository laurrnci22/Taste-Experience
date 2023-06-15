<?php
require_once "../../config.php";
require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();

use recette\Donnees;

$gdb = new Donnees();

$data = $_POST;

if(isset($data)){
    /*Ajout categorie a la bd */
    $gdb->ajoutCategorie($data['nomCategorie']);
    array_push($data,array('nomCategorie'=>$data['nomCategorie']));

    $id = $gdb->getIdCategorie($data['nomCategorie']);
    array_push($data,array('idCategorie'=>$id[0]->ID_categorie));
}
else{
    header("Location:".$GLOBALS['DOCUMENT_DIR']."index.php");
    exit();
}

header("Content-Type: application/json");
echo json_encode($data);
exit();