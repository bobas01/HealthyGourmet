<?php
class UserController extends Controller
{
    public function connexion()
    {
        session_start();
        global $router;

        $manager = new UserModel();
        $datasConnexion = $manager->getConnexion($_POST['mail']);

        $pass = $_POST['password'];


        if ($datasConnexion !== null && password_verify($pass, $datasConnexion['password'])) {
            $_SESSION['id_user'] = $datasConnexion['id'];
            $_SESSION['mail'] = $datasConnexion['mail'];
            $_SESSION['connected'] = true;
            header('Location: ./');
            exit();
        } else {
            header('Location: ./?err=1');
            exit();
        }
    }
    public function register()
    {
        global $router;

        $manager = new UserModel();

        $datasRegister = $manager->getRegister($_POST['password']);

        $twig = $this->loaderTwig();
        $registered = $router->generate('homeConnect');

        echo $twig->render('homePage.html.twig', ['register' => $datasRegister,  'registered' => $registered]);
    }
    public function verif()
    {
        global $router;

        $manager = new UserModel();

        $datasRegister = $manager->getRegister($_POST['password']);
        $datasVerif = $manager->getVerif();



        if ($datasVerif['count'] > 0) {
            header('Location: ./home?erro=1');
            exit();
        } else {
            $datasRegister;
            header('Location: ./home');
            exit();
        }


       
    }
    public function disconnect()
    {
        session_start();
        if( $_SESSION['connected'] = true){
           session_destroy();
        header('location: ./');
    } 
        }
        
}
