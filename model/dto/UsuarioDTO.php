<?php

class UsuarioDTO{
    private $idusuario;
    private $username;
    private $password;
    private $role;
    private $status;
    public function __construct(){}
    public function getIdusuario(){return $this->idusuario;}
    public function setIdusuario($idusuario){$this->idusuario = $idusuario;}
    public function getUsername(){return $this->username;}
    public function setUsername($username){$this->username = $username;}
    public function getPassword(){return $this->password;}
    public function setPassword($password){$this->password = $password;}
    public function getRole(){return $this->role;}
    public function setRole($role){$this->role = $role;}
    public function getStatus(){return $this->status;}
    public function setStatus($status){$this->status = $status;}

}

?>