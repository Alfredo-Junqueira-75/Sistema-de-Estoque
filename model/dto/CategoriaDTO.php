<?php

class categoriaDTO{

    private $id;
    private $category;

    public function __construct(){}

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getCategory(){return $this->category;}
    public function setCategory($category){$this->id = $category;}
}


?>