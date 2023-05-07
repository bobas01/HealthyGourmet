<?php 
abstract class Controller {
    public function loaderTwig()
    { 
        session_start();
        $loader = new \Twig\Loader\FilesystemLoader('./view');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('get', $_GET);
       
        return $twig;
    }
}