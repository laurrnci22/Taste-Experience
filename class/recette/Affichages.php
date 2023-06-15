<?php
namespace recette;

use recette\Formulaires;

class Affichages{
    private $formulaire;
    private $donnees;
    public function __construct(){
        $this->formulaire = new \recette\Formulaires();
        $this->donnees = new \recette\Donnees();
    }

    public function AfficherRecette($recette,$ingredients,$recetteMemeCategories,$tags): void{?>
        <!-- affichage de ma recette -->
        <script src = "<?= $GLOBALS['JS_DIR']?>modifier.js"></script>
        <script src = "<?= $GLOBALS['JS_DIR']?>supprimer_ingredient.js"></script>


        <div class="recette-cadre" id="ID_recette">
            <div class="picture-infos-recette">

                <!-- photo de la recette-->
                <div class="position-relative">
                    <img class = "recette-picture" src="<?= $GLOBALS['IMG_DIR']."recettes/".$recette->photo ?>" alt="photo recette" />
                    <?php if(isset($_SESSION['username'])) : ?>
                        <img class = "pen" id="penImages" src="<?= $GLOBALS['IMG_DIR']."src/pen.svg"?>"  alt="pen icon"/>
                    <?php endif;?>
                </div>

                <!--Nom de la recette-->
                <div class="infosRecette">
                    <div class="recette-name">
                        <?= $recette->titre ?>
                        <?php if(isset($_SESSION['username'])) : ?>
                            <img class = "pen" id="pen_name" src="<?= $GLOBALS['IMG_DIR']."src/pen.svg"?>"  alt="pen icon"/>
                        <?php endif;?>
                    </div>
                    <!-- description -->
                    <div class="description">
                       <?= $recette->description ?> <?php if(isset($_SESSION['username'])) : ?> <a href="#ID_recette"> <img class = "pen" id="pen_description" src="<?= $GLOBALS['IMG_DIR']."src/pen.svg"?>"  alt="pen icon"/></a><?php endif;?>
                    </div>

                    <!-- tag -->
                    <div class="tags">
                        <?php foreach  ($tags as $tag): ?>
                            <span class="tag">#<?= $tag->nom ?></span>
                        <?php endforeach; ?>
                         <?php if(isset($_SESSION['username'])) : ?>
                            <img id = "pen_tag" class = "pen" src="<?= $GLOBALS['IMG_DIR']."src/pen.svg"?>" alt="pen icon"/>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            <!-- ingredients de la recette  -->
            <div class="Listes-ingredients">
                <h2 class="subTitle">
                    Ingrédients
                </h2>
                <div class="ingredients">
                    <?php foreach  ($ingredients as $ingredient): ?>
                        <li class = "ingredient position-relative">
                            <img class = "ingredient-picture" src="<?= $GLOBALS['IMG_DIR']."ingredients/".$ingredient->photo ?>" alt="photos ingredients" />
                            <div class="ingredient-info"><?= $ingredient->Qte ?> </div>
                            <div class="ingredient-info"><?= $ingredient->mesure ?></div>
                            <div class="ingredient-info"><?= $ingredient->nom ?></div>

                            <?php if(isset($_SESSION['username'])) : ?>
                                <a href="#ID_recette" class="ingredientsModifier">
                                    <img class = "pen" src="<?= $GLOBALS['IMG_DIR']."src/pen.svg"?>" alt="pen icon"/>
                                </a>
                                <!-- button delete -->
                                <a id = "ID-delete-btn" class = "btn-supp-Ingredient btn"  >X</a>

                                <form method="post" class="supp" action="<?= $GLOBALS['SUPPRESSION'] ?>supprimerIngredient.php">
                                    <input type="hidden" name="Id_ingedient[]" id="<?= $ingredient->ID_ingredient ?>" value="<?= $ingredient->ID_ingredient ?>" >
                                    <input type="hidden" name="Id_recette" id="<?= $recette->ID_recette ?>" value="<?= $recette->ID_recette ?>" >
                                </form>
                            <?php endif;?>
                        </li>

                        <!-- Pour modifier un ingredient -->
                        <form method="post" class="cadre super_cadre" id="<?= $ingredient->nom?>" enctype="multipart/form-data" action="<?= $GLOBALS['MODIFICATION'] ?>modifierListesIngredient.php">
                            <span class="title-modif">Modifier l'ingredient</span>
                            <img class = "ingredient-picture-modif" src="<?= $GLOBALS['IMG_DIR']."ingredients/".$ingredient->photo ?>" alt="" />

                            <div id="ingredients-modifier">
                                <input type="text" class = "ajout-input" id = "qte" name="Quantité" placeholder="Quantité"value ="<?= $ingredient->Qte ?>" >
                                <input class = "ajout-input" type="text" id = "unite" name="Unite" placeholder="unite" value ="<?= $ingredient->mesure ?>">
                                <input type="hidden" name="idRecette" value="<?= $recette->ID_recette ?>">
                                <input type="hidden" name="idIngredient" value="<?= $ingredient->ID_ingredient ?>">
                            </div>

                            <div class="btn_class">
                                <button type="submit" class = "btn modifierBtn" id="" >Modifier</button>
                                <button type="button" class = "btn annulerBtn annulerButtonIngredient" id="" >Annuler</button>
                            </div>
                        </form>


                    <?php endforeach;?>

            </div>
             <?php if(isset($_SESSION['username'])) : ?>
             <div id="bouton_ajout_ing">
                 <a href="#ID_recette" >
                   <button type="button" class="btn" id="ajouter_Ingredient_message">+ Ajouter</button>
                 </a>
             </div>
             <?php endif;?>


            <!-- Formulaire pour modifier les elements -->

            <!-- pour le nom -->
            <form method="post" id="modifierNom" class="cadre super_cadre"  action="<?= $GLOBALS['MODIFICATION'] ?>modifierRecette.php">
                <span class="title-modif">Modifier le nom</span>
                <div id="nom">
                    <input class = "ajout-input" type="text" id = "" name="nom_recette" placeholder="" value="<?= $recette->titre ?>">
                </div>
                <div class="btn_class">
                    <button type="submit" class = "btn modifierBtn" id="" >Modifier</button>
                    <button type="button" class = "btn annulerBtn" id="annulerButtonNom" >Annuler</button>
                </div>
            </form>


            <!-- pour l'image de la recette -->

            <form method="post" class="cadre super_cadre" id="modifierImage" enctype="multipart/form-data" action="<?= $GLOBALS['MODIFICATION'] ?>modifierRecette.php">
                <span class="title-modif">Modifier l'image</span>
                <img class = "ingredient-picture-modif" src="<?= $GLOBALS['IMG_DIR']."recettes/".$recette->photo ?>" alt="" />

                <div id="image-recette">
                    <input class = "ajout-input" type="file" id = "new-photo-recette" name="new-photo-recette" placeholder="">
                </div>
                <div class="btn_class">
                    <button type="submit" class = "btn modifierBtn" id="" >Modifier</button>
                    <button type="button" class = "btn annulerBtn" id="annulerButtonImage" >Annuler</button>
                </div>
            </form>

            <!-- pour la description de la recette -->

            <form method="post" class="cadre super_cadre" id = "modifDescription" action="<?= $GLOBALS['MODIFICATION'] ?>modifDescription.php" >
                <span class="title-modif">Modifier description</span>
                <div id="description">
                    <input type="hidden" name="idRecette" value="<?= $recette->ID_recette ?>">
                    <textarea class="ajout-input" id="description-recette" name="description" placeholder="" required><?= $recette->description ?></textarea>
                </div>
                <div class="btn_class">
                    <button type="submit" class = "btn modifierBtn" id="" >Modifier</button>
                    <button type="button" class = "btn annulerBtn" id="annulerButtonDescription" >Annuler</button>
                </div>
            </form>

            <!-- Ajouter un ingredient existant -->
            <form  method="post" id = "formulaire-ajouter-ingredient" class = "cadre super_cadre"  action="<?= $GLOBALS['MODIFICATION'] ?>modifierAjoutIngredient.php" >
                <div id="ingredients">
                    <span class="title-modif">Modifier Ingrédient</span>

                    <div class="subTitle">Ingrédients</div>

                        <?php $AllIngredients = $this->donnees->getIngredient(); ?>
                            <select id="choixIngredients" class="ajout-input" name="choixIngredients">
                                <?php foreach  ($AllIngredients as $ingredient): ?>
                                    <option value="<?= $ingredient->ID_ingredient?>"><?= $ingredient->nom ?></option>
                                <?php endforeach;?>
                            </select>


                        <input type="text" class = "ajout-input" id = "qte" name="Quantite" placeholder="Quantite" value = "">
                        <input class = "ajout-input" type="text" id = "unite" name="Unite" placeholder="unite" value = "">
                        <input type="hidden" name="idRecette" value="<?= $recette->ID_recette ?>">

                        <div class="btn_class">
                            <button type="submit" class = "btn" id="ajouterIngredientBtn" >Ajouter un ingrédient</button>
                            <a href="#" type="button" class = "btn" id="creerIngredient" >Creer un nouvel ingredient</a>
                            <button type="button" class = "btn annulerBtn" id="annulerButtonAjoutIngredient" >Annuler</button>
                        </div>
                    </div>

                </div>
            </form>

            <!-- pour les tags -->
            <?php
                $EnsembleTag = "";
                foreach  ($tags as $tag):
                    $EnsembleTag = $EnsembleTag . $tag->nom." ";
                endforeach;
            ?>
            <form method="post" id = "modifierTag" class="cadre super_cadre"  action="<?= $GLOBALS['MODIFICATION'] ?>modiftag.php" >
                <span class="title-modif">Modifier Tag</span>
                <div id="tagModif">
                    <input type="hidden" name="idRecette" value="<?= $recette->ID_recette ?>">
                   <input type="text" class = "ajout-input" name="tag" value="<?= $EnsembleTag ?>">
                 </div>
                <div class="btn_class">
                    <button type="submit" class = "btn modifierBtn" id="" >Modifier</button>
                    <button type="button" class = "btn annulerBtn" id="annulerButtonTag" >Annuler</button>
                </div>
            </form>



         <form  method="post" class = "cadre super_cadre" id = "ajout-ingredient-form" action="<?= $GLOBALS['AJOUT'] ?>ajoutIngredientTraitement.php"  enctype="multipart/form-data">
            <div class="Title-Ajout">Ajouter un nouveau ingredient</div>
            <div class="ingredients-inputs">
                <input class = "ajout-input" type="text" id = "nom-ingredient" name="nomIngredient" placeholder="Entrer le nom de l'ingredient" value = "" required>
                <label for="photo-ingredient" class="subTitle"> Photo de l'ingredient</label>
                <input type="file" class="ajout-input" id="photo_ingredient" name="photo_ingredient" required>
            </div>

            <div class="btn_class">
                <button type="submit" id="ajouter-ingredient-button" class = "btn ValiderBtn" >Ajouter</button>
                <button type="button" id="annulerButtonAjoutIngre" class = "btn annulerBtn"  >Annuler</button> <!-- creerIngredient -->
            </div>
        </form>


            </div>


            <span  class="info">Si vous avez aimé cette recette, vous devriez essayer ces autres recettes de la même catégorie.
                Elles ont toutes des saveurs uniques qui feront saliver vos papilles gustatives !</span>


            <div class="cadre">
                <div class="items-cadre">
                         <!-- affichage de Quelques recette qui appartiennet au meme categorie -->

                  <?php foreach  ($recetteMemeCategories as $rec){
                      if($rec->ID_recette != $recette->ID_recette)
                          $this->formulaire->RecetteForm($rec);
                  }

                    ?>
                </div>
            </div>

<?php
    }

    public function Afficheingredient($ingredient):void{?>
            <!-- affichage de ma recette -->
        <script src = "<?= $GLOBALS['JS_DIR']?>modifier.js"></script>

        <div class="recette-cadre" id="ID_recette">
                    <form method="post" class="cadre super_cadre" id="modifierNom"  action="<?= $GLOBALS['MODIFICATION'] ?>modifIngredient.php">
                        <span>Modifier le nom</span>
                        <div id="nom">
                            <input class = "ajout-input" type="text" id = "" name="nom_ing" placeholder="" value="<?= $ingredient->nom ?>">
                             <input type="hidden" name="idIngredient" value="<?= $ingredient->ID_ingredient ?>">
                        </div>

                        <div class="btn_class">
                            <button type="submit" class = "btn modifierBtn" id="" >Modifier</button>
                            <button type="button" class = "btn annulerBtn" id="annulerButtonNom" >Annuler</button>
                        </div>
                    </form>


                    <div class="recette-name"> <?= $ingredient->nom ?>
                            <img class = "pen" id="pen_name" src="<?= $GLOBALS['IMG_DIR']."src/pen.svg"?>"  alt="pen icon"/>
                    </div>

                    <div class="position-relative">
                        <img class = "recette-picture " src="<?= $GLOBALS['IMG_DIR']."ingredients/".$ingredient->photo ?>" alt="photo ing" />
                        <img class = "pen" id="penImages" src="<?= $GLOBALS['IMG_DIR']."src/pen.svg"?>"  alt="pen icon"/>
                    </div>

                    <form method="post" class="cadre super_cadre" id="modifierImage" enctype="multipart/form-data" action="<?= $GLOBALS['MODIFICATION'] ?>modifIngredient.php">
                        <span>Modifier l'image</span>
                        <div id="image-recette">
                            <input class = "ajout-input" type="file" id = "new-photo-ing" name="new-photo-ing" placeholder="">
                        </div>

                        <div class="btn_class">
                            <button type="submit" class = "btn modifierBtn" id="" >Modifier</button>
                            <button type="button" class = "btn annulerBtn" id="annulerButtonImage" >Annuler</button>
                        </div>
                          <input type="hidden" name="idIngredient" value="<?= $ingredient->ID_ingredient ?>">
                    </form>


                    <?php
    }

    public function AfficherListesRecettesMin($recettes):void{ ?>
        <div class="cadre">
         <h1 class="title-cadre"> Recettes </h1>
            <div class="items-cadre">
                <?php foreach ($recettes as $rec){
                    $this->formulaire->RecetteForm($rec);
                } ?>
            </div>
        </div>
   <?php }
    public function AfficherParCategorie($Id_categorie,$Listescategorie,$categories,$ListesRecettes):void{?>
            <div class="cadre">
                 <?php  foreach  ($categories as $categorie): ?>
                   <?php if($categorie->ID_categorie == $Id_categorie): ?>
                        <div class="title-cadre"><?= $categorie->nom ?></div> <!-- Titre de la categorie-->
                    <?php endif;?>
                 <?php endforeach;?>
                       <div class="items-cadre">
                             <?php
                             foreach  ($Listescategorie as $lcategories){
                                if($lcategories->ID_categorie == $Id_categorie){
                                    foreach ($ListesRecettes as $rec){
                                        if($rec->ID_recette == $lcategories->ID_recette){
                                            $this->formulaire->RecetteForm($rec);
                                        }
                                    }
                                }
                             }
                             ?>
                       </div>
                <?php
        }
    public function AfficherListesCategories($categories,$gdb):void{?>
        <div class="cadre"><!-- genere un block de categorie -->

            <h1 class="title-cadre"> Categories </h1>
            <div class="items-cadre">
                <?php foreach ($categories as $t) :?>
                    <?php $image = $gdb->rechercheCategorie($t->ID_categorie);
                    if($image != null ):
                        $image = $image[0]->photo; ?>
                           <?php $this->formulaire->CategorieForm($image,$t);?>

                    <?php endif; ?>
                <?php endforeach;?>
            </div>
        </div>
        <?php
    }
    public function AfficherListesRecherches($recettesRecherchee,$ListesRecettes): void { ?>
    <style>
    #main-content{
        display: none;
    }
</style>
    <div class="search-results">
     <div class="items-cadre">
     <?php
     $flag = true;
        foreach ($recettesRecherchee as $rec){
            foreach ($ListesRecettes as $rec1){
                if($rec->titre == $rec1->titre){
                     $this->formulaire->RecetteForm($rec1);
                     $flag = false;
                }
            }
        }
        if($flag) : ?>
        <div class="message">Pas de recette(s) trouvée(s)</div>
        <?php endif;
            ?>
         </div>
         </div>
        <?php
    }

     public function AfficherIngredientRecherches($ingredients): void { ?>
        <style>
        #main-content{
            display: none;
        }
    </style>
        <div class="search-results" id="IngSearch" >
         <div class="items-cadre" >
         <?php
            $flag = true;

            foreach ($ingredients as $ingredient){
                 $this->formulaire->IngredientForm($ingredient);
                 $flag = false;
            }

             if($flag) : ?>
                <div class="message">Pas d'ingredient(s) trouve(s)</div>
        <?php endif;?>
             </div>
             </div>
            <?php
    }

     public function AfficherTagRecherches($tags): void { ?>
        <style>
        #main-content{
            display: none;
        }
        </style>
        <div class="search-results" id="TagSearch" >
            <div class="items-cadre" >
                <?php
                $flag = true;
                foreach ($tags as $tag){ ?>
                    <div class="tagAffiche">
                        <div class="tag-Item">
                            <?= $tag->nom ?>
                        </div>

                    </div>
                    <?php $flag = false;
                }
                if($flag) : ?>
                    <div class="message">Pas de tag(s) trouvé(s)</div>
                <?php endif;?>
            </div>
        </div>
            <?php
    }

     public function AfficheDonneesTest( $recette , $listeIng, $listecategorie): void{
         echo "Nom de la recette est " . $recette['titre'] . " et la photo est " . $recette['photo'] . "<br>";
         foreach ($listeIng as $lg)
             echo "Nom : " . $lg['nom'] . " Photo : " . $lg['photo'] . " Mesure : " . $lg['mesure'] . " Quantité :" . $lg['Qte'] . "<br>"; // quantite
         foreach ($listecategorie as $lscategorie) echo $lscategorie['nom'] . " ";
    }
    public function AfficherErreur(): void{
        ?>
        <style>
            .erreur{
                color: red;
                text-align: center;
                font-size: 0.8cm;
            }
        </style>
        <?php
        if(!isset($_SESSION['recette']) ){
            ?> <div class="erreur"> <?php echo "Veuiller remplir le formulaire de la recette!!"; ?></div><?php
        }
        if(!isset($_SESSION['listeIngredients'])){?>
            <div class="erreur"> <?php echo "Veuiller remplir le formulaire des ingrédients!!"; ?></div><?php
        }
        if(!isset($_SESSION['nom-categorie'])) {
            ?> <div class="erreur"> <?php echo "Veuiller remplir le formulaire des categories!!"; ?></div><?php
        }
    }

}