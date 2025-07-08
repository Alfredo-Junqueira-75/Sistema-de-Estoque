<?php

    include_once (__DIR__ ."/../conect/DBConnection.php");
    include_once (__DIR__ ."/../dto/CompraDTO.php");

    class CompraDAO{

        private $pdo;

    public function __construct()
    {
        $this->pdo = DBConnection::getConnection();
    }

    public function getConn(){
        return $this->pdo;
    }

    public function purchase(CompraDTO $compraDTO){
        try{
            $sql = "INSERT INTO compra(cliente, data, produtos, idusuario, preco_total) VALUES (:cliente, :data, :produtos, :idusuario, :preco_total)";
            
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':cliente', $compraDTO->getCliente());
            $stm->bindValue(':data', $compraDTO->getData());
            $stm->bindValue(':produtos', $compraDTO->getProdutos());
            $stm->bindValue(':idusuario', $compraDTO->getIdUsuario());
            $stm->bindValue(':preco_total', $compraDTO->getPrecoTotal());

            return $stm->execute();
        }catch( PDOException $e){
            error_log("Erro na inserção de dados da compra: " . $e->getMessage());
            return false;
        }
    }

    public function getAll(){
        try{
            $sql = "SELECT * from compra";
            $stm = $this->pdo->prepare($sql);
            if ($stm->execute()) {
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } else {
                error_log("Erro ao executar a consulta: " . $stm->errorInfo()[2]);
                return [];
            }
        }catch(PDOException $e) {
            error_log("erro ao listar compras". $e->getMessage());
            return [];
        }
        
    }
    
    public function getById($id) {
        try {
            $sql = "SELECT * FROM compra WHERE idcompra = :id";

            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':id', $id);
            $stm->execute();

            $compraDTO = $stm->fetchObject('CompraDTO');
            return $compraDTO;

        } catch (PDOException $e) {
            error_log("Erro na leitura de dados da compra: " . $e->getMessage());
            return null;
        }
    }

    public function deletePurchase($id){
        try{
            $sql = "DELETE FROM `compra` WHERE idcompra = :id";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':id', $id);
            
            $stm->execute();
        }catch( PDOException $e){
            error_log("Erro na deleção de dados da compra: " . $e->getMessage());
        }
    }

    }