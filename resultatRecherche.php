<?php
require_once "config.php" ;
session_start();


require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use recette\Template ;
use recette\Donnees;

$gdb = new Donnees() ;

ob_start() ;

if( isset($_SESSION['rechercheRecette']) ) {
    $recettesRecherchee =  $_SESSION['rechercheRecette'];
    foreach ($recettesRecherchee as $rec): ?>
        <div class="recette-index centrer">
            <div class="photo-recette centrer">
                <img class = "image-recette-index" src="<?= $GLOBALS['IMG_DIR']."recettes/".$rec->photo ?>" alt="" />
            </div>
            <div class="nom-recette-index centrer">
                <?= $rec->titre ?>
            </div>
        </div>
    <?php endforeach;

    if(empty($recettesRecherchee))
    unset($_SESSION['rechercheRecette']);//pour effacer automatiquement la recherche apres avoir recherché
}



$content = ob_get_clean();
$title = "The Taste Experience";
Template::render($content, $title);