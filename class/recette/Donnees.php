<?php
namespace recette;

use PDO;
use pdo\PdoConnexion;

class Donnees extends PdoConnexion
{

    public function getRecettes()
    {
        $statement = parent::getPdo()->prepare("SELECT * FROM recette");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
        // return parent::getPdo();
    }

    public function getTag()
    {
        $statement = parent::getPdo()->prepare("SELECT * FROM tag");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function getListestag()
    {
        $statement = parent::getPdo()->prepare("SELECT * FROM listestag");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function getListescategorieRecettes()
    {
        $statement = parent::getPdo()->prepare("SELECT * FROM listescategorie");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function getcategorieRecettes()
    {
        $statement = parent::getPdo()->prepare("SELECT * FROM categorie");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function getListesIngredients()
    {
        $statement = parent::getPdo()->prepare("SELECT * FROM listesingredients");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function getIngredient()
    {
        $statement = parent::getPdo()->prepare("SELECT * FROM ingredient ORDER BY nom ASC");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function ajoutRecette($titre, $photo, $description)
    {
        $statement = parent::getPdo()->prepare("INSERT INTO recette ( titre,photo,description) VALUES (:titre, :photo, :description)");
        $statement->bindValue(':titre', $titre);
        $statement->bindValue(':photo', $photo);
        $statement->bindValue(':description', $description);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function ajoutIngredient($nom, $photo)
    {
        $statement = parent::getPdo()->prepare("INSERT INTO ingredient ( nom,photo) VALUES ( :nom, :photo)");
        $statement->bindValue(':nom', $nom);
        $statement->bindValue(':photo', $photo);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function ajoutCategorie($nom)
    {
        $statement = parent::getPdo()->prepare("INSERT INTO categorie (nom) VALUES ( :nom)");
        $statement->bindValue(':nom', $nom);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function rechercheTerme($mot)
    {
        $sql = "select titre from recette where ID_recette IN(
        select ID_recette from recette where titre like '%" . $mot . "%' UNION select ID_recette from categorie A inner join listescategorie using (ID_categorie)  where A.nom like '%" . $mot . "%'
    UNION
        select ID_recette from ingredient B inner join listesingredients using (ID_ingredient) where B.nom like '%" . $mot . "%'
    UNION 
        select ID_recette from listestag  inner join tag B using (ID_tag) where B.nom like '%" . $mot . "%'
)";
        $statement = parent::getPdo()->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheCategorie($id_Cat)
    {
        $statement = parent::getPdo()->prepare("select photo from recette A inner join listescategorie B using(ID_recette) where B.ID_categorie =" . $id_Cat . " ORDER BY RAND() LIMIT 1");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheRecetteMin()
    {
        $statement = parent::getPdo()->prepare("select * from recette ORDER BY RAND() LIMIT 8");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function supprimerRecette($id)
    {
        $statement = parent::getPdo()->prepare(" delete from recette where  ID_recette = " . $id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function miseAjourSupprimer()
    {
        $statement = parent::getPdo()->prepare("delete from ingredient where ID_ingredient not in( select ID_ingredient from listesingredients)");
        $statement->execute() or die(var_dump($statement->errorInfo()));

        $statement = parent::getPdo()->prepare("delete from categorie where ID_categorie not in( select ID_categorie from listescategorie)");
        $statement->execute() or die(var_dump($statement->errorInfo()));

        $statement = parent::getPdo()->prepare("delete from ingredient where ID_ingredient not in( select ID_ingredient from listesingredients)");
        $statement->execute() or die(var_dump($statement->errorInfo()));


    }

    public function getIdRecette($nomRecette)
    {
        $statement = parent::getPdo()->prepare("select ID_recette from recette  where titre ='" . $nomRecette . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function getIdIngredient($nomIng)
    {
        $statement = parent::getPdo()->prepare("select ID_ingredient from ingredient  where nom ='" . $nomIng . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function getIdCategorie($nomcat)
    {
        $statement = parent::getPdo()->prepare("select ID_categorie from categorie  where nom ='" . $nomcat . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function ajoutCategorieRecette($ID_recette, $ID_categorie)
    {
        $statement = parent::getPdo()->prepare("INSERT INTO  listescategorie (ID_recette, ID_categorie ) VALUES ( :ID_recette, :ID_categorie )");
        $statement->bindValue(':ID_recette', $ID_recette);
        $statement->bindValue(':ID_categorie', $ID_categorie);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }


    public function ajoutIngredientRecette($ID_ingredient, $ID_recette, $qte, $mesure)
    {
        $statement = parent::getPdo()->prepare("INSERT INTO listesingredients (ID_ingredient, ID_recette, Qte, mesure) VALUES (:ID_ingredient, :ID_recette, :qte, :mesure )");
        $statement->bindValue(':ID_recette', $ID_recette);
        $statement->bindValue(':ID_ingredient', $ID_ingredient);
        $statement->bindValue(':qte', $qte);
        $statement->bindValue(':mesure', $mesure);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function ajoutTagRecette($ID_tag, $ID_recette)
    {
        $statement = parent::getPdo()->prepare("INSERT INTO listestag (ID_tag, ID_recette) VALUES (:ID_tag, :ID_recette)");
        $statement->bindValue(':ID_recette', $ID_recette);
        $statement->bindValue(':ID_tag', $ID_tag);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }


    public function ajoutTag($nomTag)
    {
        $statement = parent::getPdo()->prepare("INSERT INTO tag (nom) VALUES (:nom)");
        $statement->bindValue(':nom', $nomTag);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function getTagId($nomtag)
    {
        $statement = parent::getPdo()->prepare("select ID_tag from tag  where nom ='" . $nomtag . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function modifNomRecette($idRecette, $newNom)
    {
        $statement = parent::getPdo()->prepare("UPDATE recette set titre = '" . $newNom . "' where ID_recette =" . $idRecette);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function modifPhotoRecette($idRecette, $photo)
    {
        $statement = parent::getPdo()->prepare("UPDATE recette set photo = '" . $photo . "' where ID_recette =" . $idRecette);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function modifListesIngredient($idRecette, $idIngredient, $unite, $mesure)
    {
        $statement = parent::getPdo()->prepare("UPDATE listesingredients set Qte='" . $unite . "',mesure='" . $mesure . "' where ID_ingredient=" . $idIngredient . " and ID_recette=" . $idRecette);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function modifDescriptionRecette($idRecette, $descr)
    {
        $statement = parent::getPdo()->prepare("UPDATE recette set description = '" . $descr . "' where ID_recette =" . $idRecette);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function getPhotoRecette($idrecette)
    {
        $statement = parent::getPdo()->prepare("select photo from recette  where ID_recette =" . $idrecette);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheingredient($idingredient)
    {
        $statement = parent::getPdo()->prepare("SELECT ID_ingredient
      FROM ingredient
      WHERE nom LIKE CONCAT('%', $idingredient, '%')
      LIMIT 1");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }


    public function rechercheIngredientsRecette($idRecette)
    {
        $statement = parent::getPdo()->prepare("select * from ingredient A INNER join listesingredients using (ID_ingredient) where ID_recette ='" . $idRecette . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheCategoriesRecette($idRecette)
    {
        $statement = parent::getPdo()->prepare("select * from categorie A INNER join listescategorie using (ID_categorie) where ID_recette ='" . $idRecette . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheTagsRecette($idRecette)
    {
        $statement = parent::getPdo()->prepare("select * from tag A INNER join listestag using (ID_tag) where ID_recette ='" . $idRecette . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheRecette($idRecette)
    {
        $statement = parent::getPdo()->prepare("select * from recette where ID_recette ='" . $idRecette . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheRecetteMemeCategories($idRecette)
    {
        $statement = parent::getPdo()->prepare("SELECT DISTINCT A.* from recette A  INNER JOIN listescategorie USING (ID_recette) WHERE ID_categorie in(
select ID_categorie from categorie A INNER join listescategorie using (ID_categorie) where ID_recette ='" . $idRecette . "') LIMIT 6; ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheIngredientTerme($terme){
        $statement = parent::getPdo()->prepare("select * from ingredient where nom like '%" . $terme . "%' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheTagTerme($terme){
        $statement = parent::getPdo()->prepare("select * from tag where nom like '" . $terme . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function rechercheIngredientavecId($iding){
        $statement = parent::getPdo()->prepare("select * from ingredient where ID_ingredient = " . $iding);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function modifNomIngredient($idIngredient,$newNom){
        $statement = parent::getPdo()->prepare("UPDATE ingredient set nom = '" . $newNom . "' where ID_ingredient =" . $idIngredient);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function modifPhotoIngredient($idIngredient,$newPhoto){
        $statement = parent::getPdo()->prepare("UPDATE ingredient set photo = '" . $newPhoto . "' where ID_ingredient =" . $idIngredient);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function getPhotoing($iding){
        $statement = parent::getPdo()->prepare("select photo from ingredient  where ID_ingredient =" . $iding);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function supprimerIngredientRecette($idIngredient, $idRecette){
        $statement = parent::getPdo()->prepare(" delete from listesingredients where ID_recette =".$idRecette." and ID_ingredient = ".$idIngredient);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function rechercheIDTag($nameTag){
        $statement = parent::getPdo()->prepare("select ID_tag from tag where nom = '" . $nameTag . "' ");
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function SupprimerTag($ID_tag, $ID_recette){
        $statement = parent::getPdo()->prepare("delete from listestag where ID_tag =".$ID_tag." AND ID_recette =".$ID_recette);
        $statement->execute() or die(var_dump($statement->errorInfo()));

    }
















}



















