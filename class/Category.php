<?php
require_once './model/Model.php';
class Category {
    Private $id = 1;
    Private $name = 'cake';
    Private $parent_id = 1;
   
   
    

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
    public function getParent_id(){
        return $this->parent_id;
    }
    
     
     public function setId(int $id){
        return $this->id=$id;
    }
     public function setName(string $name){
        return $this->name=$name;
    }
    public function setParent_id(string $parent_id){
        return $this->parent_id=$parent_id;
    }
}