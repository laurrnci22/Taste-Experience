<?php
require_once "../../config.php";
session_start();
require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use recette\Template;

ob_start() ;

if(isset($_SESSION['username'])){?>
    <style>
        .search{
            display: none;
        }
    </style>
    <div class="supprimer-recette">
        <div class="titleSuppression">Supprimer une recette</div>
        <form method="post"  action="<?php $GLOBALS['DOCUMENT_DIR'] ?>rechercheSuppTraitement.php" class="" id="supprimer-recette-form">
            <input class = "input-search supp-search" type="text" id="fname" name="fname" placeholder="recherche supprimer">
            <input class= "btn search-btn" type="submit" value="Search">
        </form>
        <div class="supp">

        <?php if (isset($_SESSION['rechercheSuppRecette'])){

             $recettesRecherchee =  $_SESSION['rechercheSuppRecette'];

            foreach ($recettesRecherchee as $rec): ?>
                <div class="recette-aSupprimer centrer">
                    <div class="nom-recetteSupprimer"> <?= $rec->titre ?></div>
                    <form class="cadre-aSupprimer">
                        <img class = "image-supprimer" src="<?= $GLOBALS['IMG_DIR']."recettes/".$rec->photo ?>" alt="" />
                        <button type="submit" id = "" class="btn-suppID btn btn-supp">X</button>
                    </form>
                </div>
            <?php endforeach;
            unset($_SESSION['rechercheSuppRecette']); ?>
        </div>
    <script src = "<?= $GLOBALS['JS_DIR'] ?>supprimer_recette.js"></script>
    <script src = "<?= $GLOBALS['JS_DIR'] ?>admin.js"></script>
    <div>

    <?php
     }
}
else{
   echo "problem";
}

$content = ob_get_clean();
Template::render($content, $title = "Supprimer recettes");
