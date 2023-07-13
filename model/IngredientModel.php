<?php


class IngredientModel extends Model
{
    public function addIngredients($ingredientData, $recipeId)
    {
        $ingredients = [];
        $ingredientNewRecipe = $this->getDb()->prepare("INSERT INTO ingredient (name, unity)
         VALUES (:name, :unity)");


        $quantityNewRecipe = $this->getDb()->prepare("INSERT INTO ingredient_recipe(recipe_id, ingredient_id, quantity) VALUES (:recipe_id, :ingredient_id,:quantity)");
        for ($i = 0; $i < count($ingredientData); $i++) {
            $name = $ingredientData[$i]['name'];
            $unity = $ingredientData[$i]['unity'];
            $quantity = $ingredientData[$i]['quantity'];

            $ingredientNewRecipe->bindParam(':name', $name, PDO::PARAM_STR);
            $ingredientNewRecipe->bindParam(':unity', $unity, PDO::PARAM_STR);
            $ingredientNewRecipe->execute();
            $idtemp = $this->getDb()->lastInsertId();
            $ingredients[] = $idtemp;

            $quantityNewRecipe ->bindParam(':recipe_id', $recipeId, PDO::PARAM_INT); 
            $quantityNewRecipe ->bindParam(':ingredient_id', $idtemp, PDO::PARAM_INT); 
            $quantityNewRecipe ->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $quantityNewRecipe->execute(); 
        }

        return $ingredients;
    }
}
