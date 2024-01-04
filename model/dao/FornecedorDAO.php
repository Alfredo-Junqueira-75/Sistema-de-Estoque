<?php

include_once(__DIR__ . "/../conect/DBConnection.php");
include_once(__DIR__ . "/../dto/FornecedorDTO.php");

class FornecedorDAO extends DBConnection {

    private $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }

    public function getConn() {
        return $this->pdo;
    }

    public function create(FornecedorDTO $fornecedor) {
        try {
            $sql = "INSERT INTO fornecedor(idfornecedor, nome, email, telefone) VALUES(uuid(), :nome, :email, :telefone)";

            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':nome', $fornecedor->nome);
            $stm->bindValue(':email', $fornecedor->email);
            $stm->bindValue(':telefone', $fornecedor->telefone);
            return $stm->execute();

        } catch (PDOException $e) {
            echo "Erro na inserção de dados: " . $e->getMessage();
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM fornecedor WHERE idfornecedor = :id";

            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':id', $id);
            $stm->execute();

            $fornecedorDTO = $stm->fetchObject('FornecedorDTO');
            return $fornecedorDTO;

        } catch (PDOException $e) {
            echo "Erro na leitura de dados: " . $e->getMessage();
        }
    }

    public function update($id, FornecedorDTO $fornecedor) {
        try {
            $sql = "UPDATE fornecedor SET nome = :nome, email = :email, telefone = :telefone WHERE idfornecedor = :id";

            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':nome', $fornecedor->nome);
            $stm->bindValue(':email', $fornecedor->email);
            $stm->bindValue(':telefone', $fornecedor->telefone);
            $stm->bindValue(':id', $id);
            return $stm->execute();

        } catch (PDOException $e) {
            echo "Erro na atualização de dados: " . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM fornecedor WHERE idfornecedor = :id";

            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':id', $id);
            return $stm->execute();

        } catch (PDOException $e) {
            echo "Erro na exclusão de dados: " . $e->getMessage();
        }
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM fornecedor";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Erro ao obter todos os dados: " . $e->getMessage();
        }
    }
}

?>

