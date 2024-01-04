<?php

include_once(__DIR__ . "/../conect/DBConnection.php");
class CategoriaDAO extends DBConnection
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DBConnection::getConnection();
    }

    public function getConn(){
        return $this->pdo;
    }

    public function all(){
        try{
            $sql = "SELECT * from categoria";
            $stm = $this->pdo->prepare($sql);
            if ($stm->execute()) {
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } else {
                echo "Erro ao executar a consulta: " . $stm->errorInfo()[2];
            }
        }catch(PDOException $e) {
            echo "erro ao listar categorias". $e->getMessage();
        }
        
    }

    

}

?>