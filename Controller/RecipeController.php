<?php
class RecipeController extends Controller {
    public function homePage()
    {
        global $router;
        $manager = new RecipeModel();
        $datasRandom= $manager->getRandomRecipe();
       
        $datasBreakfast = $manager->getLastFourBreakfast();
      
        $datasEntree = $manager->getLastFourEntree();
        $datasMaincourse = $manager->getLastFourMaincourse();
        $datasDessert = $manager->getLastFourDessert();
        
        
        $twig = $this->loaderTwig();

        $link = $router->generate('home');

        echo $twig->render('homePage.html.twig', ['random'=> $datasRandom,'breakfasts'=> $datasBreakfast, 'entrees'=> $datasEntree, 'maincourses' => $datasMaincourse, 'desserts' => $datasDessert, 'link' => $link]);
    }
}