<?php

class UsuarioDAO extends DBConnection{

    private $pdo;

    public function __construct(){
        $this->pdo = DBConnection::getConnection();
    }

    public function getConn() {
        return $this->pdo;
    }

    public function signUp(UsuarioDTO $usuarioDTO)
    {
        $name = $usuarioDTO->getUsername();
        echo $name;

        $hashPassword = password_hash($usuarioDTO->password, PASSWORD_DEFAULT);
        $stm = $this->pdo->prepare("INSERT INTO usuario( idusuario, username, password) VALUES (uuid(),:username, :password)");
        $stm->bindParam(':username', $usuarioDTO->getUsername);
        $stm->bindParam(':password', $hashPassword);
        $stm->execute();

    }

    public function validarUsuario($username, $password) {
        $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE username = :username AND password = :password AND role = 'user' AND status = 'active'");
        $stm->bindParam(':username', $username);
        $stm->bindParam(':password', $password);
        $stm->execute();

        return $stm->rowCount();
    }

    public function validarAdmin($username, $password) {
        $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE username = :username AND password = :password AND role = 'admin' AND status = 'active'");
        $stm->bindParam(':username', $username);
        $stm->bindParam(':password', $password);
        $stm->execute();

        return $stm->rowCount();
    }
    

}


?>