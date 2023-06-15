<?php
session_start();
require_once "../../config.php";

require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();

use recette\Donnees;

$gdb = new Donnees();


if (isset($_POST['idIngredient'])) {

    $idIng = (int)$_POST['idIngredient'];
    if (isset($_POST['nom_ing'])) {
        $gdb->modifNomIngredient($idIng, htmlspecialchars($_POST['nom_ing']));
    }

    if (isset($_FILES['new-photo-ing'])) {

        if (empty($_FILES['new-photo-ing'])) die("<span style='color : red'>Il n'y a pas de photo de recettes insérées !</span>");
        $file = $_FILES['new-photo-ing']; // NB : 'le_fichier' est le name de votre input dans le formulaire

        if ($file['error'] == 0) {//tout va bien
            $temp_file_name = $file['tmp_name'];
            $file_name = $file['name'];

            //conservation de l ancienne photo
            $old_photo = $gdb->getPhotoing($idIng);

            //modification du photo correspondante
            $gdb->modifPhotoIngredient($idIng,$file_name);
            $dir_name = "../../images/ingredients/";//l'endroit ou on va insérer l'image !!
            if (!is_dir($dir_name)) mkdir($dir_name);//verification de la repertoire si ca existe déjà
            $full_name = $dir_name . $file_name;
            move_uploaded_file($temp_file_name, $full_name);

            //suppression de l ancienne image dans le serveur
            $file_path = "../images/ingredients/" . $old_photo[0]->photo;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }
    $_SESSION['idIngredientModif'] = $_POST['idIngredient'];
}

header("Location:".$GLOBALS['AFFICHAGES']."afficheIngredient.php");
exit();


