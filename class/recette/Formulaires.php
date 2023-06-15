<?php
namespace recette;

class Formulaires{
    private $donnees;
    public function __construct(){
        $this->donnees = new \recette\Donnees();
    }
    public function RecetteForm($recette):void{?>
        <script src = "<?= $GLOBALS['JS_DIR'] ?>etoiles.js"></script>

        <form method="post" class="item-cadre" action="<?= $GLOBALS['AFFICHAGES'] ?>afficheRecette.php">
            <figure class="item-infos">
                <img class = "item-picture" src="<?= $GLOBALS['IMG_DIR']."recettes/".$recette->photo ?>" alt="Photo recette" />
                <figcaption class="item-name">  <?= $recette->titre ?>  </figcaption>
                <div class="etoiles">
                    <?php for($i = 0 ; $i < 5 ;$i++) :?>
                        <span class="etoile" style="color: white">&#9733;</span>
                    <?php endfor;?>
                </div>
            </figure>

            <input type="hidden" name="Id_recette" id="<?= $recette->ID_recette ?>" value="<?= $recette->ID_recette ?>" >
            <?php  if(isset($_SESSION['username'])){?>
                <a id = "ID-delete-btn" class = "btn-supp btn"  >X</a>
            <?php } ?>
        </form>
        <form method="post" class="supp" action="<?= $GLOBALS['SUPPRESSION'] ?>supptraitement.php">
            <input type="hidden" name="Id_recette" id="<?= $recette->ID_recette ?>" value="<?= $recette->ID_recette ?>" >
        </form>

        <?php
    }

    public function IngredientForm($ingredient):void{?>
        <form method="post" class="item-cadre" action="<?= $GLOBALS['AFFICHAGES'] ?>afficheIngredient.php">
            <figure class="item-infos">
                <img class = "item-picture"  src="<?= $GLOBALS['IMG_DIR']."ingredients/".$ingredient->photo ?>" alt="Dinosaur" />
                <figcaption class="item-name">  <?= $ingredient->nom ?>  </figcaption>
            </figure>
            <input type="hidden" name="Id_ingredient" id="<?= $ingredient->ID_ingredient ?>" value="<?= $ingredient->ID_ingredient ?>" >

        </form>
        <?php
    }


    public function CategorieForm($image,$categorie):void{?>
        <form method="post" class="item-cadre" action="<?= $GLOBALS['AFFICHAGES'] ?>afficheCategorie.php">
            <figure class="item-infos">
                <img class = "item-picture" src="<?= $GLOBALS['IMG_DIR']."recettes/".$image ?>" alt="" />
                <figcaption class="item-name">  <?= $categorie->nom ?> </figcaption>
            </figure>
            <input type="hidden" id="<?= $categorie->ID_categorie?>" value="<?= $categorie->ID_categorie?>" name="Id_categorie">
        </form>
        <?php
    }

    public function AjoutForm():void{?>
        <script src = "<?= $GLOBALS['JS_DIR']?>ajouter.js"></script>
        <div class="position-relative">
        <form method="post" class="cadre" id="ajout-recette-form"  enctype="multipart/form-data" action="<?= $GLOBALS['AJOUT'] ?>ajoutRecetteTraitement.php">
            <!--                Ajout des informations de la recette-->
            <div class="Title-Ajout">Ajouter une recette</div>

            <div id="recette">
                <input class = "ajout-input" type="text" id = "nom_recette" name="nom_recette" placeholder="Entrer le nom de la recette" required> <!-- nom de la recette -->
                <label for="le_fichier" class="subTitle"> Photo de la recette </label> <!-- Image de la recette -->
                <input type="file" class="ajout-input" id="photo_recette" name="photo_recette" required>
            </div>

            <!--                liste des categories de la recette-->

            <div id="categories">
                <div class="subTitle">Categories</div>
                    <div id="listeCategorie">
                            <?php $Allcategories = $this->donnees->getcategorieRecettes(); ?>
                            <?php  foreach  ($Allcategories as $categorie): ?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input check" name="categorie[]" id="<?= $categorie->ID_categorie?>" value="<?= $categorie->ID_categorie?>">
                                    <label class="form-check-label" for="dessert"> <?= $categorie->nom ?> </label>
                                </div>
                            <?php endforeach;?>


                    </div>
                <a href="#ajout-recette-form" class="btn" id="creerCategorie">Creer une nouvelle Categorie</a>
                </div>

            <!--                liste des ingredients de la recette-->
            <div id="ingredients">
                <div class="subTitle">Ingrédients</div>
                <div id="listeIngredient"></div>


                <select id="choixIngredients" class="ajout-input" name="choixIngredients">
                    <?php $AllIngredients = $this->donnees->getIngredient(); ?>
                    <?php  foreach  ($AllIngredients as $ingredient): ?>
                        <option value="<?= $ingredient->ID_ingredient?>"><?= $ingredient->nom ?></option>
                    <?php endforeach;?>
                </select>

                <input type="text" class = "ajout-input" id = "qte" name="Quantité" placeholder="Quantité" value = "" min = 0>
                <input class = "ajout-input" type="text" id = "unite" name="Unite" placeholder="unite" value = "">

                <div class="btn_class">
                    <button type="button" class = "btn" id="ajout-ingre" >Ajouter un ingrédient</button>
                    <a href="#ajout-recette-form" type="button" class = "btn" id="creerIngredient" >Creer un nouvel ingredient</a>
                </div>
            </div>

            <!--                liste des Tags de la recette             -->
            <div id="tag">
                <div class="subTitle">Tag</div>
                <div class="tagListe">
                    <?php foreach ($_SESSION['Tags'] as $tag):?>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input check" name="tag[]" id="" value="">
                            <label class="form-check-label" for="dessert"> <?= $tag->nom ?> </label>
                        </div>
                    <?php endforeach;?>
                </div>
                <input class = "ajout-input" type="text" id = "nom-tag" name="Nom-tag" placeholder="Ajout les tags" value = "">
            </div>
            <div id="description">
                <div class="subTitle">Description</div>

                <textarea class="ajout-input" id="description-recette" name="description" placeholder="Description de la recette" required></textarea>
            </div>

            <button type="submit" id = "ajout-recette" class="btn" value="Ajouter la recette" >Ajouter la recette</button>
        </form>


        <!--            Pour ajouter les ingredients-->
        <form  method="post" class = "cadre super_cadre" id = "ajout-ingredient-form" action="<?= $GLOBALS['AJOUT'] ?>ajoutIngredientTraitement.php"  enctype="multipart/form-data">
            <div class="Title-Ajout">Ajouter un nouveau ingredient</div>
            <div class="ingredients-inputs">
                <input class = "ajout-input" type="text" id = "nom-ingredient" name="nomIngredient" placeholder="Entrer le nom de l'ingredient" value = "" required>
                <label for="photo-ingredient" class="subTitle"> Photo de l'ingredient</label>
                <input type="file" class="ajout-input" id="photo_ingredient" name="photo_ingredient" required>
            </div>

            <div class="btn_class">
                <button type="submit" id="ajouter-ingredient-button" class = "btn ValiderBtn" >Ajouter</button>
                <button type="button" id="creerIngredient" class = "btn annulerBtn"  >Annuler</button>
            </div>
        </form>

        <!--            Pour ajouter les categories    -->
        <form  method="post" class = "cadre super_cadre" id = "ajout-categorie-form" action="<?= $GLOBALS['AJOUT'] ?>ajoutCategorieTraitement.php" >
            <div class="Title-Ajout">Ajouter une nouvelle categorie</div>
            <div class="categorie-inputs">
                <input class = "ajout-input" type="text" id = "nom-categorie" name="nomCategorie" placeholder="Entrer la categorie" value = "" required>
            </div>
            <div class="btn_class">
                <button type="submit" id="ajouter-ingredient-button" class = "btn ValiderBtn" >Ajouter</button>
                <button type="button" class = "btn annulerBtn" id="creerIngredient" >Annuler</button>
            </div>
        </form>
        </div>

        <?php
    }

    public function RechecherForm():void{?>
      <form id = "searchID-form" class = "form-search centrer" action="<?= $GLOBALS['RECHERCHE'] ?>rechercheTraitement.php" method="POST">
            <input class = "input-search" type="search" id="searchID" name="fname" placeholder="dessert,chocolat,fruit..." required>
            <button class= "btn search-btn" type="submit" value="Search">Search</button>
      </form>
        <?php
    }



}