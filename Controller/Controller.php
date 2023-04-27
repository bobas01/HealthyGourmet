<?php 
abstract class Controller {
    public function loaderTwig()
    {
        $loader = new \Twig\Loader\FilesystemLoader('./view');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        return $twig;
    }
}