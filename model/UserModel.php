<?php
class UserModel extends Model
{
    public function getConnexion($mail)
    {
        $user = null;
        $connect = $this->getdb()->prepare("SELECT `id`, `mail`, `password` FROM `user` WHERE `mail` = :mail");
        $connect->bindParam('mail', $mail, PDO::PARAM_STR);
        $connect->execute();
        if ($connect->rowCount() == 1) {
            $user = $connect->fetch(PDO::FETCH_ASSOC);
            
        }
       
        return $user;
    }
    public function getVerif()
    {
        $verif = $this->getdb()->prepare("SELECT COUNT(*) as count FROM `user` WHERE `username` = :username OR `mail` = :mail");
        $verif->bindParam(':username', $username, PDO::PARAM_STR);
        $verif->bindParam(':mail', $mail, PDO::PARAM_STR);
        $verif->execute();
        $result = $verif->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getRegister($pass)
    {

        $passHashed = password_hash($pass, PASSWORD_DEFAULT);
        $username = $_POST['username'];
        $mailVerif = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);

        if (!empty($_POST)) {

                $register = $this->getdb()->prepare("INSERT INTO `user` ( `username`, `password`, `mail`, `created-at`) VALUES ( :username, :pass, :mail, NOW())");


                $register->bindParam('username', $username, PDO::PARAM_STR);
                $register->bindParam('pass', $passHashed, PDO::PARAM_STR);
                $register->bindParam('mail', $mailVerif, PDO::PARAM_STR);
                $register->execute();
                
                return $register;
            
        }
    }
}
