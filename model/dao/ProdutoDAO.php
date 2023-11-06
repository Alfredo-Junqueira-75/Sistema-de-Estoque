<?php 

class ProdutoDAO{
    public static function create(ProdutoDTO $produto){
        try{
            $sql = "INSERT INTO `sistema_de_estoque`.`produto` (`nome`, `descricao`, `preco`, `quant_em_estoque`, `cod_de_barra`, `idfornecedor`) VALUES (:nome, :descricao, :preco, :quant_em_estoque, :cod_de_barra, :idfornecedor);";
            $sql_procedure = DBConnection::getConnection()->prepare(sql);
            $sql_procedure.bindValue(":nome", $produto->getNome);

        }catch(PDOException $e){
            print "erro ". $e->getMessage();}
    }
}

?>