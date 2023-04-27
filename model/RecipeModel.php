<?php
class RecipeModel extends Model {
    public function getRandomRecipe(){
        $random=$this->getdb()->query('SELECT  `recipe`.`id`,`title`,`thumbnail`,`description` FROM `recipe`
        INNER JOIN `category_recipe`
        ON `category_recipe`.`recipe_id`=`recipe`.`id`
        INNER JOIN `category`
        ON `category_recipe`.`category_id`= `category`.`id`
         ORDER BY RAND(`recipe`.`id`)LIMIT 1;');
         $test= $random->fetch(PDO::FETCH_ASSOC);
         $random= new Recipe($test);
        
         return $test;
    }
    public function getLastFourEntree()
    {
        $entrees = [];

        $lastEntree = $this->getdb()->query('SELECT  `recipe`.`id`,`title`,`thumbnail`,`description` FROM `recipe`
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

        $lastBreakfasts = $this->getdb()->query('SELECT `recipe`.`id`,`title`,`thumbnail`,`description` FROM `recipe`
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

        $lastMaincourse = $this->getdb()->query('SELECT `recipe`.`id`,`title`,`thumbnail`,`description` FROM `recipe`
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

        $lastDessert = $this->getdb()->query('SELECT `recipe`.`id`,`title`,`thumbnail`,`description` FROM `recipe`
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

}