<?php
require_once './vendor/autoload.php';

require_once './vendor/altorouter/altorouter/AltoRouter.php';

$router = new AltoRouter();
$router->setBasePath('/php/HealthyGourmet');

$router->map('GET', '/', 'RecipeController#homePage', 'home' );
$router->map('POST', '/homeConnect', 'UserController#connexion', 'homeConnect' );
// $router->map('POST', '/homeConnect', 'UserController#connexion', 'homeConnectPOST' );




$router->map('GET', '/search', 'RecipeController#resultResearch', 'resultResearch' );


$match = $router->match();

if(is_array($match)){
    list($controller, $action)= explode('#', $match['target']);
    $obj= new $controller();

    if(is_callable(array($obj,$action))){
        call_user_func_array(array($obj, $action), $match['params']);
    }
}