<?php

class FornecedorDTO{
    private $id;
    public $nome;
    public $email;
    public $telefone;

    public function __construct(){}
    public function getId(){return $this->id;}
    public function setId($id){$this->id=$id;}
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome=$nome;}
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email=$email;}
    public function getTelefone(){return $this->telefone;}
    public function setTelefone($telefone){$this->telefone=$telefone;}

}

?>