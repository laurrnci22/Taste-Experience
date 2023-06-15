<?php
session_start();
require_once "../../config.php";

require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();

use recette\Donnees;

$gdb = new Donnees() ;

$idRec = (int)$_SESSION['idRecetteModif'];

if(isset($_SESSION['idRecetteModif'])){

    if(isset($_POST['nom_recette']) ){
        $gdb->modifNomRecette($idRec,htmlspecialchars($_POST['nom_recette']));
    }

    if(isset($_FILES['new-photo-recette'])) {

        if (empty($_FILES['new-photo-recette'])) die("<span style='color : red'>Il n'y a pas de photo de recettes insérées !</span>");
        $file = $_FILES['new-photo-recette']; // NB : 'le_fichier' est le name de votre input dans le formulaire

        if ($file['error'] == 0) {//tout va bien
            $temp_file_name = $file['tmp_name'];
            $file_name = $file['name'];

            //conservation de l ancienne photo
            $old_photo = $gdb->getPhotoRecette($idRec);

            //modification du photo correspondante
            $gdb->modifPhotoRecette($idRec, $file_name);
            $dir_name = "../../images/recettes/";//l'endroit ou on va insérer l'image !!
            if (!is_dir($dir_name)) mkdir($dir_name);//verification de la repertoire si ca existe déjà
            $full_name = $dir_name . $file_name;
            move_uploaded_file($temp_file_name, $full_name);

            //suppression de l ancienne image dans le serveur
            $file_path = "../../images/recettes/" . $old_photo[0]->photo;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    $_SESSION['idRecetteRedirection'] = $_SESSION['idRecetteModif'];

}
header("Location:".$GLOBALS['AFFICHAGES']."afficheRecette.php");
exit();