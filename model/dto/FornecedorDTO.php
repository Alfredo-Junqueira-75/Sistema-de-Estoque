<?php

class FornecedorDTO{
    private $id;
    public $nome;
    public $email;
    public $telefone;

    public function __construct(){}
    public function getId(){return $this->id;}
    public function setId($id){$this->id=$id;}
    public function getName(){return $this->nome;}
    public function setName($name){$this->nome=$name;}
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email=$email;}
    public function getTelefone(){return $this->telefone;}
    public function setTelefone($telefone){$this->telefone=$telefone;}

}

?>