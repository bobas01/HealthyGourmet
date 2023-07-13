<?php
session_start();
require_once './vendor/autoload.php';

require_once './vendor/altorouter/altorouter/AltoRouter.php';

$router = new AltoRouter();
$router->setBasePath('/php/HealthyGourmet');

$router->map('GET', '/', 'RecipeController#homePage', 'home' );

$router->map('POST', '/login', 'UserController#login', 'login' );

$router->map('GET', '/search', 'RecipeController#resultResearch', 'resultResearch' );

$router->map('GET', '/disconnect', 'UserController#disconnect', 'disconnect' );

$router->map('POST', '/register', 'UserController#register', 'register' );

$router->map('POST', '/newRecipe', 'RecipeController#newRecipe', 'newRecipe' );

$router->map('POST', '/newIngredient', 'IngredientController#newIngredient', 'newIngredient' );

$router->map('GET', '/yourRecipe', 'RecipeController#yourRecipe', 'yourRecipe' );

$router->map('GET', '/recipe/','', 'baseRecipe');
$router->map('GET', '/recipe/[i:id]?', 'RecipeController#oneRecipe', 'oneRecipe');



$match = $router->match();
// var_dump($match);

if(is_array($match)){
    list($controller, $action)= explode('#', $match['target']);
    $obj= new $controller();

    if(is_callable(array($obj,$action))){
        call_user_func_array(array($obj, $action), $match['params']);
    }
}