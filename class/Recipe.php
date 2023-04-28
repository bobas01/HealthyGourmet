<?php
require_once './model/Model.php';
class Recipe {
    Private $id = 1;
    Private $title = 'cake';
    Private $ingredient_id = 1;
    Private $thumbnail = 'monimage.jpg';
    Private $user_id= 1;
    Private $published_at = 'published_at';
    Private $difficulty = 20;
    Private $duration = 20;
    Private $cooking_time = 20;
    Private $number_of_person = 1;
    Private $description = "blbblza";
    Private $step = "step";
    
  
   
    

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
    public function getTitle(){
        return $this->title;
    }
    public function getIngredient_id(){
        return $this->ingredient_id;
    }
    public function getThumbnail(){
        return $this->thumbnail;
    }
     public function getUser_id(){
       return $this->user_id;
    }
     public function getPublished_at(){
       return $this->published_at;
    }
    public function getDifficulty(){
        return $this->difficulty;
     }
    public function getDuration(){
        return $this->duration;
     }
    public function getCooking_time(){
        return $this->cooking_time;
     }
    public function getNumber_of_person(){
        return $this->number_of_person;
     }
    public function getDescription(){
        return $this->description;
     }
    public function getStep(){
        return $this->step;
     }

     
     public function setId(int $id){
        return $this->id=$id;
    }
     public function setTitle(string $title){
        return $this->title=$title;
    }
    public function setIngredient_id(string $ingredient_id){
        return $this->ingredient_id=$ingredient_id;
    }
    public function setThumbnail(string $thumbnail){
        return $this->thumbnail=$thumbnail;
    
    }
    public function setuser_id(string $user_id){
        return $this->user_id=$user_id;
    }
    
    public function setPublished_at(string $published_at){
        return $this->published_at=$published_at;
    }
    public function setDifficulty(string $difficulty){
        return $this->difficulty=$difficulty;
    }
    public function setDuration(int $duration){
        return $this->duration=$duration;
    }    
    public function setCooking_time(?int $cooking_time){
        return $this->cooking_time=$cooking_time;
    }
    public function setNumber_of_person(int $number_of_person){
        return $this->number_of_person=$number_of_person;
    }
    public function setDescription(string $description){
        return $this->description=$description;
    }
    public function setStep(string $step){
        return $this->step=$step;
    }
    
    
}