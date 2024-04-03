<?php

include_once(__DIR__ . "/../conect/DBConnection.php");
include_once(__DIR__ . "/../dto/UsuarioDTO.php");

class UsuarioDAO extends DBConnection{

    private $pdo;

    public function __construct(){
        $this->pdo = DBConnection::getConnection();
    }

    public function getConn() {
        return $this->pdo;
    }

    public function create(UsuarioDTO $usuarioDTO)
    {
        try{
            $stm = $this->pdo->prepare("INSERT INTO usuario( idusuario, username, password, role, status) VALUES (uuid(),:username, :password, :role, :status)");
            $username = $usuarioDTO->getUsername(); 
            $password = $usuarioDTO->getPassword();           
            $role = $usuarioDTO->getRole();
            $status = $usuarioDTO->getStatus();
            $stm->bindParam(':username', $username);
            $stm->bindParam(':password', $password);
            $stm->bindParam(':role', $role);
            $stm->bindParam(':status', $status);
            $stm->execute();
        }catch(PDOException $e){
            echo "Error inserting data: " . $e->getMessage();
        }
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

    public function getAllUsuarios() {
        try {
            $conn = $this->getConn();

            $sql = "SELECT * FROM `usuario`";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro na busca de usuários: " . $e->getMessage();
            return array();
        }
    }
        public function getUsuarioById($id) {
            try {
                $conn = $this->getConn();
        
                $sql = "SELECT * FROM `usuario` WHERE idusuario = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
        
                $array = $stmt->fetchObject('UsuarioDTO');
                return $array;
            } catch (PDOException $e) {
                echo "Erro na busca do usuário por ID: " . $e->getMessage();
                return null;
            }
        }

        public function deleteUsuario($id) {
            try {
                $conn = $this->getConn();
    
                $sql = "DELETE FROM `usuario` WHERE idusuario = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erro na exclusão do usuário: " . $e->getMessage();
            }
        }

        public function updateUsuario(UsuarioDTO $usuarioDTO) {
            try {
                $conn = $this->getConn();
    
                $sql = "UPDATE `usuario` SET password = :password, role = :role, status = :status WHERE idusuario = :id";
                $stmt = $conn->prepare($sql);
    
                $password = password_hash($usuarioDTO->getPassword(), PASSWORD_DEFAULT);
                $stmt->bindParam(':password', $password);
                $role = $usuarioDTO->getRole();           
                $stmt->bindParam(':role', $role);
                $status = $usuarioDTO->getStatus();
                $stmt->bindParam(':status', $status);
                $id = $usuarioDTO->getIdusuario();
                $stmt->bindParam(':id', $id);
    
                return $stmt->execute();
            } catch (PDOException $e) {
                echo "Erro na atualização do usuário: " . $e->getMessage();
                return false;
            }
        }
    

}


?>
