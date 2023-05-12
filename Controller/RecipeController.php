<?php
class RecipeController extends Controller
{
    public function homePage()
    {
        global $router;
        $manager = new RecipeModel();
        $datasRandom = $manager->getRandomRecipe();
        $datasBreakfast = $manager->getLastFourBreakfast();
        $datasEntree = $manager->getLastFourEntree();
        $datasMaincourse = $manager->getLastFourMaincourse();
        $datasDessert = $manager->getLastFourDessert();



        $twig = $this->loaderTwig();

        $link = $router->generate('baseRecipe');



        echo $twig->render('homePage.html.twig', ['random' => $datasRandom, 'breakfasts' => $datasBreakfast, 'entrees' => $datasEntree, 'maincourses' => $datasMaincourse, 'desserts' => $datasDessert, 'link' => $link]);
    }
    public function oneRecipe(int $id) {
        $manager = new RecipeModel();
        $datasRecipe = $manager->getOneRecipe($id);
        $datasIngredient= $manager->getIngredient($id);
       
        $twig = $this->loaderTwig();

        echo $twig->render('oneRecipe.html.twig', ['ingredients' => $datasIngredient, 'oneRecipe' => $datasRecipe]);
    }
    public function resultResearch()
    {
        global $router;
        $manager = new RecipeModel();
        $datasResultResearch = $manager->getResultReasearch($_GET['s']);



        $twig = $this->loaderTwig();
        $action = $router->generate('resultResearch');

        echo $twig->render('resultResearch.html.twig', ['resultResearchs' => $datasResultResearch, 'action' => $action]);
    }
    public function yourRecipe()
    {

        global $router;
        $manager = new RecipeModel();
        
        $datasYourRecipe = $manager->getYourRecipe($_SESSION['id_user'] );
        $datasFavorites = $manager->getFavorite($_SESSION['id_user'] );
      
        
        $twig = $this->loaderTwig();
        $linkRecipe = $router->generate('yourRecipe');

        echo $twig->render('yourRecipe.html.twig', ['yourRecipes' => $datasYourRecipe, 'favorites' =>$datasFavorites, 'linkRecipe' => $linkRecipe]);
    }
    

    // public function newRecipe()
    // {

    //     global $router;
    //     $manager = new RecipeModel();
    //     $datasNewRecipe = $manager->getAddRecipe($_POST['description'], $_POST['user_id'], $_POST['title'], $_POST['difficulty'], $_POST['duration'],  $_POST['cooking_time'], $_POST['step']);



    

    //     if ($datasNewRecipe) {
    //         try {
    //             $_SESSION['success'] = "Recette ajouté ajouté";
    //             header('Location: ./newRecipe');
    //             exit();
    //         } catch (PDOException $e) {
    //             header('Location: ./newRecipe');
    //             $_SESSION['success'] = "Il y a eu un problème lors de l'enregistrement des informations. Veuillez réessayer à nouveau.";
    //             exit();
    //         }
    //     }
    // }
   
}
