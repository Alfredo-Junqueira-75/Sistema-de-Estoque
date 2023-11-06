<?php

class UsuarioDTO{
    private $idusuario;
    private $username;
    private $password;

    public function __construct(){}
    public function getIdusuario(){return $this->idusuario;}
    public function setIdusuario($idusuario){$this->idusuario = $idusuario;}
    public function getUsername(){return $this->username;}
    public function setUsername($username){$this->username = $username;}
    public function getPassword(){return $this->password;}
    public function setPassword($password){$this->password = $password;}
    

}

?>