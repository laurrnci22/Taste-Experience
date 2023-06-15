<?php
use recette\Formulaires;
use recette\Affichages;
use recette\Donnees;

$gdb = new Donnees();
$recettes = $gdb->getRecettes();
$ingredients = $gdb->getIngredient();
$formulaire = new Formulaires();
$affichage = new Affichages();
?>
<header id = "header">

    <div class="part1">
       <a href="<?= $GLOBALS['DOCUMENT_DIR']?>index.php" class="title"><img class="img-logo" src ="<?= $GLOBALS['IMG_DIR']?>src/logo.png"/></a>
        <a href="<?= $GLOBALS['DOCUMENT_DIR']?>index.php" class="btn-head home">Accueil</a>
        <a href="<?= $GLOBALS['DOCUMENT_DIR']?>index.php#idCat" class="btn-head home">Catégories</a>
        <a href="<?= $GLOBALS['DOCUMENT_DIR']?>index.php#idRec" class="btn-head home">Recettes</a>

        <div class="logMenu">

            <?php

            if(isset($_SESSION['username'])){?>
                <a class = "btn-head" href="<?php echo $GLOBALS['PAGES'] ?>admSpace.php" >Ajout</a>
                <a class = "btn-head" href="<?php echo $GLOBALS['AUTHENTIFICATION'] ?>logout.php" >Logout</a>

                <?php
            }
            else{?>
                <a class = "btn-head" href="<?php echo $GLOBALS['AUTHENTIFICATION'] ?>login.php">Sign in</a>
                <?php
            }
            ?>

        </div>
    </div>

    <div class="search"><?php
        $formulaire->RechecherForm();

         ?>
    </div>

</header>

<?php if (isset($_SESSION['search'])):?>

<div id="type-search">
    <div id="filtre">
        <img class="img-filtre" src ="<?= $GLOBALS['IMG_DIR']?>src/Filtre-transformed.png"/>
        <span id = "text-filtre">Filtrer</span>
    </div>
    <div class="filtre-choix">
        <div class="form-check-search hidden-choice">
            <input type="checkbox" class="check" name="ingredient" id="" value="IngSearch" checked>
            <label class="form-check-label" for="ingredient">Ingredient</label>
        </div>
        <div class="form-check-search hidden-choice">
            <input type="checkbox" class="check" name="tag" id="" value="TagSearch" checked>
            <label class="form-check-label" for="tag">Tag</label>
        </div>
    </div>
</div>


<script>
        let inputs = undefined
        let inputArray = undefined
        document.addEventListener('DOMContentLoaded', function (){
            let div = document.getElementById("type-search")
             inputs = div.getElementsByTagName('input')
            let bouton = document.getElementById("filtre")
            let text = document.getElementById("text-filtre");



            // Convertir la collection en tableau
            inputArray = Array.from(inputs);

            bouton.addEventListener('click', function (){
               let input = document.getElementsByClassName("form-check-search");
               array = Array.from(input);

                array.forEach(cb => {
                    cb.classList.toggle("hidden-choice")
                    text.classList.toggle("hidden-choice")
                });
            })

            inputArray.forEach(check => check.addEventListener('change', function (event){
                displayCheckboxes()
            }))
        })

        function displayCheckboxes() {
            inputArray.forEach(cb => {
             // console.log(cb.value)
                let div = document.getElementById(cb.value);

                if (!cb.checked) {
                    div.classList.add(cb.value);
                }

                else{
                    div.classList.remove(cb.value);
                }

            });
        }
    </script>
<?php endif;?>


<?php
    if (isset($_SESSION['rechercheRecette'])) {
        $recettesRecherchee = $_SESSION['rechercheRecette'];
        $tableauUnique = array_unique($recettesRecherchee, SORT_REGULAR);
        $affichage->AfficherListesRecherches($tableauUnique, $recettes);
        unset($_SESSION['rechercheRecette']);//pour effacer automatiquement la recherche apres avoir recherché
    }
    if(isset($_SESSION['checkedIngredient'])) {
        $checkedIngredient = $_SESSION['checkedIngredient'];
        $tableauUnique = array_unique($checkedIngredient, SORT_REGULAR);
        $affichage->AfficherIngredientRecherches($tableauUnique);
        unset($_SESSION['checkedIngredient']);
    }
    if(isset($_SESSION['checkedTag'])) {
        $checkedTag = $_SESSION['checkedTag'];
        $tableauUnique = array_unique($checkedTag, SORT_REGULAR);
        $affichage->AfficherTagRecherches($tableauUnique);
        unset($_SESSION['checkedTag']);
    }
    unset($_SESSION['search'])

    ?>








