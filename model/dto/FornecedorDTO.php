<?php

class FornecedorDTO{
    private $id;
    private $name;
    private $email;
    private $telefone;

    public function __construct(){}
    public function getId(){return $this->id;}
    public function setId($id){$this->id=$id;}
    public function getName(){return $this->name;}
    public function setName($name){$this->name=$name;}
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email=$email;}
    public function getTelefone(){return $this->telefone;}
    public function setTelefone($telefone){$this->telefone=$telefone;}

}

?>