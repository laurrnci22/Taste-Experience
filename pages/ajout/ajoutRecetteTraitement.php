<?php
require_once "../../config.php";
require $GLOBALS['PHP_DIR'] . "class/Autoloader.php";
Autoloader::register();
use recette\Donnees;
$gdb = new Donnees();



if(isset( $_POST['nom_recette'] )
    && isset($_FILES['photo_recette'])
    && isset($_POST['description'])
    && isset($_POST['choixIngredients'])
    && isset($_POST['Unite'])
    && isset($_POST['Quantité'])
    && isset($_POST['ingredient'])) {


    if (empty($_FILES['photo_recette'])) die("<span style='color : red'>Il n'y a pas de photo de recettes insérées !</span>");
    $file = $_FILES['photo_recette']; // NB : 'le_fichier' est le name de votre input dans le formulaire

    $nomRecette = htmlspecialchars($_POST['nom_recette']);
    if ($file['error'] == 0) {//tout va bien
        $temp_file_name = $file['tmp_name'];
        $file_name = $file['name'];

        $desc = htmlspecialchars($_POST['description']);

        $gdb->ajoutRecette($nomRecette,$file_name,$desc);
        $idRecette = $gdb->getIdRecette($nomRecette);

        $idRecette = $idRecette[0]->ID_recette;

        if(isset($_POST['categorie'])){
            foreach ($_POST['categorie'] as $cat){
                $gdb->ajoutCategorieRecette($idRecette,$cat);
            }
        }


        foreach ($_POST['ingredient'] as $ing){
            $ingredient = json_decode($ing,true);
            $gdb->ajoutIngredientRecette($ingredient["id"],$idRecette,$ingredient["quantite"],$ingredient["unite"]);
        }


        if(isset($_POST['Nom-tag'])){
            $nomtag = htmlspecialchars($_POST['Nom-tag']);

            $tagsModifs = htmlspecialchars($nomtag);
            $tagsModifs = trim($tagsModifs); // retirer les espaces
            $tableTabs = explode(" ", $tagsModifs); // decompose les mots en tableaux
            $tableTabs = array_unique($tableTabs); // recupere les mots uniques

            foreach ( $tableTabs as $mot){
                if(($gdb->getTagId($mot)) != null){
                    $gdb->ajoutTagRecette(($gdb->getTagId($mot))[0]->ID_tag, $idRecette);
                }

                else{
                    $gdb->ajoutTag($mot);
                    $gdb->ajoutTagRecette(($gdb->getTagId($mot))[0]->ID_tag, $idRecette);
                }
            }
        }

        $dir_name = "../../images/recettes/";//l'endroit ou on va insérer l'image !!
        if (!is_dir($dir_name)) mkdir($dir_name);//verification de la repertoire si ca existe déjà
        $full_name = $dir_name . $file_name;
        move_uploaded_file($temp_file_name, $full_name);
    }
    //header("Location:".$GLOBALS['AJOUT']."Ajout-Reussi.php");
    header("Location:".$GLOBALS['DOCUMENT_DIR']."index.php");
    exit();
}
else{?>
  <script>
      document.addEventListener('DOMContentLoaded',function (){
        alert("Malheureusement, la recette n'a pas été créée.");
        window.location.href = <?=  $GLOBALS['PAGES'] ?> + "ajout/ajout.php";
      })
  </script>
<?php
}

