<?php

class IngredientController extends Controller
{
    public function newIngredient()
    {
        global $router;
        $manager = new IngredientModel();
        var_dump($_POST);
          die();
        $nb = (count($_POST) - 1) / 3;
        if (isset($_POST['recipe_id'])) {
            $recipeId = $_POST['recipe_id'];
            $ingredientData = [];
              for ($i = 1; $i <= $nb; $i++) {
                $ingredientData[] = [
                    'name'  => $_POST['name'. '_' . $i] ,
                    'unity'  => $_POST['unity'. '_' . $i], 
                    'quantity'  => $_POST['quantity'. '_' . $i] 

                ];
            }
          }
          
           
            $newIngredientIds = $manager->addIngredients($ingredientData, $recipeId);
            


            header('Location: ./yourRecipe');
        }
    
}
