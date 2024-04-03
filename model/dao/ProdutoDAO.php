<?php 
include_once(__DIR__ . "/../conect/DBConnection.php");
include_once(__DIR__ . "/../dto/ProdutoDTO.php");

class ProdutoDAO extends DBConnection
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DBConnection::getConnection();
    }

    public function getConn(){
        return $this->pdo;
    }

    public function create(ProdutoDTO $produto)
    {
        try {
            $sql = "INSERT INTO produto(nome, descricao, preco, quant_em_estoque, cod_de_barra, idfornecedor, idcategoria) VALUES (:nome, :descricao, :preco, :quant_em_estoque, :cod_de_barra, :idfornecedor, :idcategoria)";

            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':nome', $produto->getNome());
            $stm->bindValue(':descricao', $produto->getDescricao());
            $stm->bindValue(':preco', $produto->getPreco());
            $stm->bindValue(':quant_em_estoque', $produto->getQuantEmEstoque());
            $stm->bindValue(':cod_de_barra', $produto->getCodDeBarra());
            $stm->bindValue(':idfornecedor', $produto->getIdfornecedor());
            $stm->bindValue(':idcategoria', $produto->getIdcategoria());

            return $stm->execute();
            
        } catch (PDOException $e) {
            echo "Erro na inserção de dados: " . $e->getMessage();
        }
    }

    public function all(){
        try{
            $sql = "SELECT * from produto";
            $stm = $this->pdo->prepare($sql);
            if ($stm->execute()) {
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } else {
                echo "Erro ao executar a consulta: " . $stm->errorInfo()[2];
            }
        }catch(PDOException $e) {
            echo "erro ao listar produtos". $e->getMessage();
        }
        
    }

    public function reduceQuant($quant_em_estoque, $nome){
        try{
            $sql = "UPDATE produto SET quant_em_estoque = quant_em_estoque - :quant_em_estoque WHERE (nome = :nome)";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':nome', $nome);
            $stm->execute();
        }catch(PDOException $e){
            echo "erro ao reduzir quantidade de estoque". $e->getMessage();
        }
    }

    public function getPriceByName($nome){
        try{
            $sql = "SELECT preco FROM produto WHERE nome = :nome";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':nome', $nome);
            return $stm->execute();
        }catch(PDOException $e){
            echo "erro ao pegar o preço pelo nome do banco de dados ". $e->getMessage();
        }
    }

    public function totalValue(){
        try{
            $sql = "SELECT SUM(preco) FROM `produto` WHERE 1";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        }catch(PDOException $e){
            echo "Erro na contagem do valor total : " . $e->getMessage();
        }
    }

    public function totalProduct(){
        try{
            $sql = "SELECT SUM(quant_em_estoque) FROM `produto` WHERE 1";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        }catch(PDOException $e){
            echo "Erro na contagem de produto : " . $e->getMessage();
        }
    }

    public function subTotalProduct($id){
        try{
            $sql = "SELECT SUM(quant_em_estoque) FROM `produto` where idcategoria = :id";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam('id', $id);
            $stm->execute();
            return $stm->fetchColumn();
        }catch(PDOException $e){
            echo "Erro na contagem de produto : " . $e->getMessage();
        }
    }

    public function delete(int $id){
        try {
            $sql = "DELETE from produto where idproduto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
        } catch (PDOException $e) {
            echo "Erro na deleção de dados: " . $e->getMessage();
        }
    }

    public function findById(int $id){
        try {
            $sql = "SELECT * from produto where idproduto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
    
            $produtoDTO = $stm->fetchObject('ProdutoDTO');
            return $produtoDTO;
        } catch (PDOException $e) {
            echo "Erro para encontrar o produto: " . $e->getMessage();
        }
    }
    


    public function update($id, ProdutoDTO $produtoDTO){
        try {
            $sql = "UPDATE produto set nome = :nome, descricao = :descricao, preco = :preco, quant_em_estoque = :quant_em_estoque, cod_de_barra = :cod_de_barra, idfornecedor = :idfornecedor, idcategoria = :idcategoria where idproduto = :id";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':nome', $produtoDTO->getNome());
            $stm->bindValue(':descricao', $produtoDTO->getDescricao());
            $stm->bindValue(':preco', $produtoDTO->getPreco());
            $stm->bindValue(':quant_em_estoque', $produtoDTO->getQuantEmEstoque());
            $stm->bindValue(':cod_de_barra', $produtoDTO->getCodDeBarra());
            $stm->bindValue(':idfornecedor', $produtoDTO->getIdfornecedor());
            $stm->bindValue(':idcategoria', $produtoDTO->getIdcategoria());
            $stm->bindValue(':id', $produtoDTO->getIdcategoria());
            $stm->execute();
        }catch (PDOException $e) {
            echo 'erro ao atualizar: '. $e->getMessage();
        }
    }
    

}


?>