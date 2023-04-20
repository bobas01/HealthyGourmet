<?php
require_once './model/Model.php';
class Ingredient {
    Private $id = 1;
    Private $name = 'cake';
    Private $unity = '1';
   
   
    

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
    public function getName(){
        return $this->name;
    }
    public function getunity(){
        return $this->unity;
    }
    
     
     public function setId(int $id){
        return $this->id=$id;
    }
     public function setName(string $name){
        return $this->name=$name;
    }
    public function setUnity(string $unity){
        return $this->unity=$unity;
    }
}