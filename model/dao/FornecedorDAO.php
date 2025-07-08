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
            error_log("Erro na inserção de dados do fornecedor: " . $e->getMessage());
            return false;
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
            error_log("Erro na leitura de dados do fornecedor: " . $e->getMessage());
            return null;
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
            error_log("Erro na atualização de dados do fornecedor: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM fornecedor WHERE idfornecedor = :id";

            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':id', $id);
            return $stm->execute();

        } catch (PDOException $e) {
            error_log("Erro na exclusão de dados do fornecedor: " . $e->getMessage());
            return false;
        }
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM fornecedor";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro ao obter todos os dados do fornecedor: " . $e->getMessage());
            return [];
        }
    }
}

?>

