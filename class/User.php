<?php
require_once './model/Model.php';
class User {
    Private $id = 1;
    Private $username = 'cake';
    Private $password = '1';
    Private $mail = 'monimage.jpg';   
    Private $create_at = 'create_at';
   
  
   
    

    public function __construct(array $datas) {
        $this->hydrate($datas);
        
    }
    private function hydrate(array $datas){
        foreach($datas as $key =>$value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public function getId(){
        return $this->id;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getMail(){
        return $this->mail;
    }
     public function getCreate_at(){
       return $this->create_at;
    }
    
     
     public function setId(int $id){
        return $this->id=$id;
    }
     public function setUsername(string $username){
        return $this->username=$username;
    }
    public function setPassword(string $password){
        return $this->password=$password;
    }
    public function setMail(string $mail){
        return $this->mail=$mail;
    
    }
    
    public function setCreate_at(string $create_at){
        return $this->create_at=$create_at;
    }
    
    
}