<?php


class IngredientModel extends Model
{
    public function addIngredients($ingredientData, $recipeId)
    {
        $ingredients = [];
        $ingredientNewRecipe = $this->getDb()->prepare("INSERT INTO ingredient (name, unity)
         VALUES (:name, :unity)");

       
        $quantityNewRecipe = $this->getDb()->prepare("INSERT INTO `ingredient_recipe`(`recipe_id`, `ingredient_id`, `quantity`) VALUES (':recipe_id','ingredient_id',':quantity')");       
        for ($i = 1; $i < count($ingredientData); $i++) {
            $name = $ingredientData['name'];
            $unity = $ingredientData['unity'];
            $quantity = $ingredientData['quantity'];

            $ingredientNewRecipe->bindParam(':name', $name, PDO::PARAM_STR);
            $ingredientNewRecipe->bindParam(':unity', $unity, PDO::PARAM_STR);
            $ingredientNewRecipe->execute();
            $ingredients[] = $this->getDb()->lastInsertId();

            $quantityNewRecipe ->bindParam(':recipe_id', $recipeId, PDO::PARAM_INT); 
            $quantityNewRecipe ->bindParam(':ingredient_id', $ingredients[$i], PDO::PARAM_INT); 
            $quantityNewRecipe ->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $quantityNewRecipe->execute(); 
        }

        $ingredientNewRecipe->closeCursor();
        return $ingredients;
    }
}
