<?php 
abstract class Controller {
    public function loaderTwig()
    { 
        
        $loader = new \Twig\Loader\FilesystemLoader('./view');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('get', $_GET);
       
        return $twig;
    }
}