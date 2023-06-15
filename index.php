<?php
require_once "config.php" ;
session_start();

require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use recette\Template ;
use recette\Donnees;
use recette\Affichages;

$gdb = new Donnees() ;
$affichage = new Affichages();

ob_start() ;

$categories = $gdb->getcategorieRecettes();
$listescategories = $gdb->getListescategorieRecettes();
$recettesMin = $gdb->rechercheRecetteMin();

if (!empty($_COOKIE['username'])){
    $_SESSION['username'] = $_COOKIE['username'] ;
}


?>
    <div class="index">
        <img class="banner" src="<?=$GLOBALS['IMG_DIR']?>src/banner.png " alt="banner">
<!--        <span id="idCat" class="info">Explorez notre collection de recettes de cuisine par catégorie</span>-->
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;Les recettes de cuisine sont des trésors gastronomiques qui ont traversé les âges et les cultures. Que ce soit pour un plat principal, un dessert, une entrée ou un apéritif, il y a une recette pour chaque occasion et chaque palais. Chaque recette est unique, avec ses propres ingrédients, ses techniques de préparation et ses saveurs distinctes. Les recettes peuvent être transmises de génération en génération, ou partagées entre amis et membres de la famille. Que vous soyez un passionné de cuisine ou que vous cherchiez simplement à élargir votre palette culinaire, les recettes sont une source d'inspiration inépuisable pour tous les gourmets.
        </p>
        <br>
        <blockquote>"La gastronomie est l'art d'utiliser la nourriture pour créer le bonheur"
            <cite>-Theodore Zeldin</cite>
        </blockquote>
        <br>
        <span id="idCat" class="info">Plongeons dans l'unvers de la cuisine. Explorez ensemble notre collection de recettes de cuisine par catégorie</span>
        <?php
        $affichage->AfficherListesCategories($categories,$gdb);
        ?>
        <span id="idRec" class="info">Découvrez notre sélection de délicieuses recettes, simples à réaliser chez vous,
        pour régaler vos papilles et épater vos convives !</span>

        <?php $affichage->AfficherListesRecettesMin($recettesMin); ?>

    </div>
<?php


$content = ob_get_clean();
$title = "The Taste Experience";
Template::render($content, $title);