<?php
class RecipeModel extends Model
{
    public function getRandomRecipe()
    {
        $random = $this->getdb()->query('SELECT  `recipe`.`id`,`title`, `user_id`, `difficulty`, `thumbnail`, `duration`, `cooking_time`, `number_of_person`, `published_at`, `description`, `step`  FROM `recipe`
        INNER JOIN `category_recipe`
        ON `category_recipe`.`recipe_id`=`recipe`.`id`
        INNER JOIN `category`
        ON `category_recipe`.`category_id`= `category`.`id`
         ORDER BY RAND(`recipe`.`id`)LIMIT 1;');
        $test = $random->fetch(PDO::FETCH_ASSOC);
        $random = new Recipe($test);

        return $test;
    }
    public function getLastFourEntree()
    {
        $entrees = [];

        $lastEntree = $this->getdb()->query('SELECT  `recipe`.`id`,`title`, `user_id`, `difficulty`, `thumbnail`, `duration`, `cooking_time`, `number_of_person`, `published_at`, `description`, `step`  FROM `recipe`
        INNER JOIN `category_recipe`
        ON `category_recipe`.`recipe_id`=`recipe`.`id`
        INNER JOIN `category`
        ON `category_recipe`.`category_id`= `category`.`id`
        WHERE `category`.`id`=2 ORDER BY `recipe`.`id` DESC LIMIT 4;');
        while ($entree = $lastEntree->fetch(PDO::FETCH_ASSOC)) {
            $entrees[] = new Recipe($entree);
        }
        $lastEntree->closeCursor();
        return $entrees;
    }
    public function getLastFourBreakfast()
    {
        $breakfasts = [];

        $lastBreakfasts = $this->getdb()->query('SELECT `recipe`.`id`,`title`, `user_id`, `difficulty`, `thumbnail`, `duration`, `cooking_time`, `number_of_person`, `published_at`, `description`, `step`  FROM `recipe`
        INNER JOIN `category_recipe`
        ON `category_recipe`.`recipe_id`=`recipe`.`id`
        INNER JOIN `category`
        ON `category_recipe`.`category_id`= `category`.`id`
        WHERE `category`.`id`=1 ORDER BY `recipe`.`id` DESC LIMIT 4;');
        while ($breakfast = $lastBreakfasts->fetch(PDO::FETCH_ASSOC)) {
            $breakfasts[] = new Recipe($breakfast);
        }
        $lastBreakfasts->closeCursor();
        return $breakfasts;
    }
    public function getLastFourMaincourse()
    {
        $Maincourses = [];

        $lastMaincourse = $this->getdb()->query('SELECT `recipe`.`id`,`title`, `user_id`, `difficulty`, `thumbnail`, `duration`, `cooking_time`, `number_of_person`, `published_at`, `description`, `step`  FROM `recipe`
        INNER JOIN `category_recipe`
        ON `category_recipe`.`recipe_id`=`recipe`.`id`
        INNER JOIN `category`
        ON `category_recipe`.`category_id`= `category`.`id`
        WHERE `category`.`id`=3 ORDER BY `recipe`.`id` DESC LIMIT 4;');
        while ($Maincourse = $lastMaincourse->fetch(PDO::FETCH_ASSOC)) {
            $Maincourses[] = new Recipe($Maincourse);
        }
        $lastMaincourse->closeCursor();
        return $Maincourses;
    }
    public function getLastFourDessert()
    {
        $desserts = [];

        $lastDessert = $this->getdb()->query('SELECT `recipe`.`id`,`title`, `user_id`, `difficulty`, `thumbnail`, `duration`, `cooking_time`, `number_of_person`, `published_at`, `description`, `step` FROM `recipe`
        INNER JOIN `category_recipe`
        ON `category_recipe`.`recipe_id`=`recipe`.`id`
        INNER JOIN `category`
        ON `category_recipe`.`category_id`= `category`.`id`
        WHERE `category`.`id`=4 ORDER BY `recipe`.`id` DESC LIMIT 4;');
        while ($dessert = $lastDessert->fetch(PDO::FETCH_ASSOC)) {
            $desserts[] = new Recipe($dessert);
        }
        $lastDessert->closeCursor();
        return $desserts;
    }
    public function getOneRecipe(int $id)
    {
        $one = $this->getdb()->prepare('SELECT `recipe`.`id`,`title`, `user_id`, `difficulty`, `thumbnail`, `duration`, `cooking_time`, `number_of_person`, `published_at`, `description`, `step`  FROM `recipe`
        WHERE `recipe`.`id`=:id');
        $one->bindParam('id', $id, (PDO::PARAM_INT));
        $one->execute();
        $oneRecipe = new Recipe($one->fetch(PDO::FETCH_ASSOC));
        $one->closeCursor();
        return $oneRecipe;
    }
    public function getIngredient(int $id)
    {
        $ingredients = [];
        $oneIngredient = $this->getdb()->prepare('SELECT  `name`, `unity`, `recipe`.`id`, `ingredient_recipe`.`quantity` FROM `ingredient`
        INNER JOIN `ingredient_recipe`
        ON `ingredient_recipe`.`ingredient_id`= `ingredient`.`id`
        INNER JOIN `recipe`
        ON `ingredient_recipe`.`recipe_id`=`recipe`.`id`
        WHERE `recipe`.`id`=:id');
        $oneIngredient->bindParam('id', $id, (PDO::PARAM_INT));
        $oneIngredient->execute();
        while ($ingredient = $oneIngredient->fetch(PDO::FETCH_ASSOC)) {
            $ingredients[] = new Ingredient($ingredient);
        }
        $oneIngredient->closeCursor();
        return $ingredients;
    }
    public function getResultReasearch($s)
    {
        $resultReasearchs = [];
        $research = null;


        if (isset($s)) {
            $s = htmlspecialchars($s);

            $research = $s;
            $research = trim($research);
            $research = strip_tags($research);
        }
        if (!empty($research)) {
            $research = strtolower($research);
            $search_term = '%' . $research . '%';

            $select_research = $this->getdb()->prepare("SELECT DISTINCT `recipe`.`id`, `recipe`.`title`, `category`.`name`, `ingredient`.`name`, `recipe`.`thumbnail`, `recipe`.`description`  FROM `recipe`
                INNER JOIN `category_recipe`
                ON `category_recipe`.`recipe_id`=`recipe`.`id`
                INNER JOIN `category`
                ON `category_recipe`.`category_id`= `category`.`id`
                INNER JOIN `ingredient_recipe`
                ON `ingredient_recipe`.`recipe_id`=`recipe`.`id`
                INNER JOIN `ingredient`
                ON `ingredient`.`id`= `ingredient_recipe`.`ingredient_id`
                
                
                
                WHERE `recipe`.`title` LIKE :search_term OR `category`.`name` LIKE :search_term OR `ingredient`.`name` LIKE  :search_term 
                GROUP BY id ;");

            $select_research->bindValue(':search_term', $search_term, PDO::PARAM_STR);

            $select_research->execute();

            while ($resultReasearch = $select_research->fetch(PDO::FETCH_ASSOC)) {
                $resultReasearchs[] = new Recipe($resultReasearch);
            }

            $select_research->closeCursor();
            return $resultReasearchs;
        } else {
            $message = "Vous devez entrer votre requete dans la barre de recherche";
            echo $message;
        }
    }


    public function getYourRecipe($id)
    {
        $yourRecipes = [];

        $lastRecipe = $this->getdb()->prepare('SELECT `recipe`.`id`,`title`, `recipe`.`user_id`, `thumbnail` FROM `recipe`
        INNER JOIN `user`
        ON `user`.`id`= recipe.`user_id`
        WHERE `user`.`id`= :id ORDER BY `recipe`.`id` DESC ;');
        $lastRecipe->bindParam(':id', $id, PDO::PARAM_INT);
        $lastRecipe->execute();

        while ($yourRecipe = $lastRecipe->fetch(PDO::FETCH_ASSOC)) {
            $yourRecipes[] = new Recipe($yourRecipe);
        }
        $lastRecipe->closeCursor();
        return $yourRecipes;
    }
    public function getFavorite($id)
    {
        $favorites = [];
        $recipeFavorite = $this->getdb()->prepare("SELECT `recipe`.`id`,`title`, `recipe`.`user_id`, `thumbnail` FROM `recipe`
        INNER JOIN `bookmate`
        ON `bookmate`.`recipe_id`=`recipe`.`id`
        INNER JOIN `user`
        ON `user`.`id`= `bookmate`.`user_id`
        WHERE `user`.`id`= :id ORDER BY `recipe`.`id` DESC");
        $recipeFavorite->bindParam(':id', $id, PDO::PARAM_INT);
        $recipeFavorite->execute();
        while ($favorite = $recipeFavorite->fetch(PDO::FETCH_ASSOC)) {
            $favorites[] = new Recipe($favorite);
        }
        $recipeFavorite->closeCursor();
        return $favorites;
    }
    public function getAddRecipe($description, $user_id, $title,  $difficulty, $duration, $cooking_time, $step, $number_of_person, $thumbnail)
    {
        



        $newRecipe = $this->getdb()->prepare("INSERT INTO `recipe`( `title`, `user_id`, `difficulty`, `duration`, `cooking_time`, `number_of_person`, `published_at`, `description`, `step`, `thumbnail`) VALUE (:title, :user_id, :difficulty, :duration, :cooking_time, :number_of_person, NOW(), :description, :step, :thumbnail )");
        $newRecipe->bindParam(':title', $title, PDO::PARAM_STR);
        $newRecipe->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $newRecipe->bindParam(':difficulty', $difficulty, PDO::PARAM_STR);
        $newRecipe->bindParam(':duration', $duration, PDO::PARAM_INT);
        $newRecipe->bindParam(':cooking_time', $cooking_time, PDO::PARAM_INT);
        $newRecipe->bindParam(':number_of_person', $number_of_person, PDO::PARAM_INT);
        $newRecipe->bindParam(':description', $description, PDO::PARAM_STR);
        $newRecipe->bindParam(':step', $step, PDO::PARAM_STR);
        $newRecipe->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
        $newRecipe->execute();
        return $newRecipe;
    }

    public function addIngredient($name, $unity) {
        $ingredients=[];
        $ingredientNewRecipe = $this->getDb()->prepare("INSERT INTO ingredient (name, unity)
        VALUES (:name, :unity)");
        $ingredientNewRecipe->bindParam(':name', $name, PDO::PARAM_STR);
        $ingredientNewRecipe->bindParam(':unity', $unity, PDO::PARAM_STR);
        $ingredientNewRecipe->execute();
        
        return $this->getDb()->lastInsertId();

    }
    public function addQuantity($quantity){
        $ingredientQuantity = $this->getDb()->prepare("INSERT INTO ingredient_recipe (ingredient_id, recipe_id, quantity)
        VALUE (:recipe_id,:quantity)
        -- SELECT `ingredient`.`id`, `ingredient`.`name`, `ingredient`.`unity` 
        -- FROM `recipe`
        -- INNER JOIN `ingredient_recipe`
        -- ON `recipe`.`id`= `ingredient_recipe`.`recipe_id`
        -- INNER JOIN `ingredient`
        -- ON `ingredient`.`id` = `ingredient_recipe`.`ingredient_id`
        -- WHERE `recipe`.`id`= (SELECT `id` FROM `recipe` ORDER BY `id` DESC LIMIT 1)
        ");
        $ingredientQuantity->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $ingredientQuantity->bindParam(':recipe_id', $recipe_id, PDO::PARAM_INT);
       
        $ingredientQuantity->execute();
        return $ingredientQuantity;
    }
   
}
