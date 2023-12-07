<?php

class FornecedorDAO extends DBConnection{

    private $pdo;

    public function __construct()
    {
        $this->pdo = DBConnection::getConnection();
    }

    public function create(FornecedorDTO $fornecedor)
    {
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
}
