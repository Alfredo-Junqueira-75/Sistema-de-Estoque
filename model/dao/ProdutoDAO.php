<?php 

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
            $sql = "INSERT INTO produto(nome, descricao, preco, quant_em_estoque, cod_de_barra, idfornecedor) VALUES (:nome, :descricao, :preco, :quant_em_estoque, :cod_de_barra, :idfornecedor)";

            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':nome', $produto->getNome());
            $stm->bindValue(':descricao', $produto->getDescricao());
            $stm->bindValue(':preco', $produto->getPreco());
            $stm->bindValue(':quant_em_estoque', $produto->getQuantEmEstoque());
            $stm->bindValue(':cod_de_barra', $produto->getCodDeBarra());
            $stm->bindValue(':idfornecedor', $produto->getIdfornecedor());

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


    public function delete(int $id){
        try {
            $sql = "DELETE * from produto where idProduto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            header("location: SistemaDeEstoque/view/produto.php");
        } catch (PDOException $e) {
            echo "Erro na deleção de dados: " . $e->getMessage();
        }
    }

    public function findById(int $id){
        try {
            $sql = "SELECT * from produto where idProduto = ?";
            $stm = $this->pdo->prepare($sql);
            return $stm->execute([$id]);
        }catch (PDOException $e) {
            echo "Erro para encontrar o produto". $e->getMessage();
        }
    }

    public function get(int $id){
        try {
            $sql = "SELECT * from produto where idProduto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            header("location: SistemaDeEstoque/view/#");
        
        } catch (PDOException $e) {
            echo "Erro na busca de dados: " . $e->getMessage();
        }
    }

    public function update(int $id, ProdutoDTO $produtoDTO){
        try {
            $sql = "UPDATE produto set nome = :nome, descricao = :descricao, preco = :preco, quant_em_estoque = :quant_em_estoque, cod_de_barra = :cod_de_barra, idfornecedor = :idfornecedor where idProduto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':nome', $produtoDTO->getNome());
            $stm->bindValue(':descricao', $produtoDTO->getDescricao());
            $stm->bindValue(':preco', $produtoDTO->getPreco());
            $stm->bindValue(':quant_em_estoque', $produtoDTO->getQuantEmEstoque());
            $stm->bindValue(':cod_de_barra', $produtoDTO->getCodDeBarra());
            $stm->bindValue(':idfornecedor', $produtoDTO->getIdfornecedor());
            $stm->execute([$id]);
        }catch (PDOException $e) {
            echo 'erro ao atualizar: '. $e->getMessage();
        }
    }
    

}


?>