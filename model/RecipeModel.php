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
    public function getResultReasearch($s)
    {
        $resultReasearchs = [];
        $research = null;
        $id = 1;

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
                ORDER BY id ;");
            $select_research->bindValue(':search_term', $search_term, PDO::PARAM_STR);

            $select_research->execute();
            while ($resultReasearch = $select_research->fetch(PDO::FETCH_ASSOC)) {
                $resultReasearchs[] = new Recipe($resultReasearch);
            }
            $select_research->closeCursor();
            return $resultReasearchs;
        } else {
            $message = "Vous devez entrer votre requete dans la barre de recherche";
        }
    }
}
