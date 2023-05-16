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
    public function oneRecipe(int $id)
    {
        $manager = new RecipeModel();
        $datasRecipe = $manager->getOneRecipe($id);
        $datasIngredient = $manager->getIngredient($id);

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

        $datasYourRecipe = $manager->getYourRecipe($_SESSION['id_user']);
        $datasFavorites = $manager->getFavorite($_SESSION['id_user']);


        $twig = $this->loaderTwig();
        $linkRecipe = $router->generate('yourRecipe');

        echo $twig->render('yourRecipe.html.twig', ['yourRecipes' => $datasYourRecipe, 'favorites' => $datasFavorites, 'linkRecipe' => $linkRecipe]);
    }

        public function newRecipe()
    {
        global $router;
        $manager = new RecipeModel();
        $datasNewRecipe = $manager->getAddRecipe(
            $_POST['description'],
            $_SESSION['id_user'],
            $_POST['title'],
            $_POST['difficulty'],
            $_POST['duration'],
            $_POST['cooking_time'],
            $_POST['step'],
            $_POST['number_of_person'],
            $_FILES['thumbnail']
        );

        if (isset($_POST['submit'])) {


            function resizeImg($tmp_name, $width, $height, $name)
            {
                list($x, $y) = getimagesize($tmp_name);

                $ratio = min($width / $x, $height / $y);
                $new_width = round($x * $ratio);
                $new_height = round($y * $ratio);

                $ext = pathinfo($name, PATHINFO_EXTENSION);

                switch ($ext) {
                    case 'jpg':
                    case 'jpeg':
                        $imageCreateFrom = 'imagecreatefromjpeg';
                        $imageExt = 'imagejpeg';
                        break;
                    case 'png':
                        $imageCreateFrom = 'imagecreatefrompng';
                        $imageExt = 'imagepng';
                        break;
                    case 'gif':
                        $imageCreateFrom = 'imagecreatefromgif';
                        $imageExt = 'imagegif';
                        break;
                    case 'webp':
                        $imageCreateFrom = 'imagecreatefromwebp';
                        $imageExt = 'imagewebp';
                        break;
                    default:
                        throw new Exception("Format d'image non pris en charge");
                }



                $image = $imageCreateFrom($tmp_name);
                $image_p = imagecreatetruecolor($new_width, $new_height);
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $x, $y);

                $imageExt($image_p, "./asset/img/" . $name);  

            }

             resizeImg($_FILES['thumbnail']['tmp_name'], 300, 300, $_FILES['thumbnail']['name']);


            try {
                $_SESSION['success'] = "Recette ajoutée";
                header('Location: yourRecipe');
                exit();
            } catch (PDOException $e) {
                header('Location: yourRecipe');
                $_SESSION['success'] = "Il y a eu un problème lors de l'enregistrement des informations. Veuillez réessayer à nouveau.";
                exit();
            }
        }
    }
    // function resizeImg($tmp_name, $width, $height, $name)
    // {
    //     list($x, $y) = getimagesize($tmp_name);

    //     $ratio = min($width / $x, $height / $y);
    //     $new_width = round($x * $ratio);
    //     $new_height = round($y * $ratio);

    //     $ext = pathinfo($name, PATHINFO_EXTENSION);

    //     switch ($ext) {
    //         case 'jpg':
    //         case 'jpeg':
    //             $imageCreateFrom = 'imagecreatefromjpeg';
    //             $imageExt = 'imagejpeg';
    //             break;
    //         case 'png':
    //             $imageCreateFrom = 'imagecreatefrompng';
    //             $imageExt = 'imagepng';
    //             break;
    //         case 'gif':
    //             $imageCreateFrom = 'imagecreatefromgif';
    //             $imageExt = 'imagegif';
    //             break;
    //         case 'webp':
    //             $imageCreateFrom = 'imagecreatefromwebp';
    //             $imageExt = 'imagewebp';
    //             break;
    //         default:
    //             throw new Exception("Format d'image non pris en charge");
    //     }

    //     $image = $imageCreateFrom($tmp_name);
    //     $image_p = imagecreatetruecolor($new_width, $new_height);
    //     imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $x, $y);

    //     $destination = "./asset/img/" . $name;

    //     $imageExt($image_p, $destination);

    //     return $destination;
    // }
    // public function newRecipe()
    // {
     

    //     global $router;
    //     $manager = new RecipeModel();

    //     if (isset($_POST['submit'])) {
    //         try {
    //             $thumbnail = $_FILES['thumbnail'];
    //             $thumbnailPath = $this->resizeImg($thumbnail['tmp_name'], 300, 300, $thumbnail['name']);

    //             $datasNewRecipe = $manager->getAddRecipe(
    //                 $_POST['description'],
    //                 $_SESSION['id_user'],
    //                 $_POST['title'],
    //                 $_POST['difficulty'],
    //                 $_POST['duration'],
    //                 $_POST['cooking_time'],
    //                 $_POST['step'],
    //                 $_POST['number_of_person'],
    //                 $thumbnailPath
    //             );

    //             $_SESSION['success'] = "Recette ajoutée";
    //             header('Location: yourRecipe');
    //             exit();
    //         } catch (Exception $e) {
    //             $_SESSION['success'] = "Il y a eu un problème lors de l'enregistrement des informations : " . $e->getMessage();
    //             header('Location: yourRecipe');
    //             exit();
    //         }
    //     }
    // }
}
