<?php

include_once(__DIR__ . "/../model/dao/ProdutoDAO.php");
include_once(__DIR__ . "/../model/dto/ProdutoDTO.php");

class ProdutoController {
    private $ProdutoDAO;
    private $ProdutoDTO;
    private $conn;

    public function __construct() {
        $this->ProdutoDAO = new ProdutoDAO();
        $this->ProdutoDTO = new ProdutoDTO();
        $this->conn = $this->ProdutoDAO->getConn();
    }

    public function cadastrarProduto($nome, $descricao, $preco, $quant_em_estoque, $idfornecedor, $idcategoria) {
        $this->ProdutoDTO->setNome($nome);
        $this->ProdutoDTO->setDescricao($descricao);
        $this->ProdutoDTO->setPreco($preco);
        $this->ProdutoDTO->setQuantEmEstoque($quant_em_estoque);
        $numeroAleatorio = rand(100000, 999999);
        $this->ProdutoDTO->setCodDeBarra($numeroAleatorio);
        $this->ProdutoDTO->setIdfornecedor($idfornecedor);
        $this->ProdutoDTO->setIdcategoria($idcategoria);
        
        if ($this->ProdutoDAO->create($this->ProdutoDTO)) {
            header("Location: ../view/admin/add_new_product.php");
        } else {
            $errorInfo = $this->conn->errorInfo();
            echo "Error inserting data: " . $errorInfo[2];
        }
    }

    public function editarProduto($id, $nome, $descricao, $preco, $quant_em_estoque, $idfornecedor, $idcategoria) {
        $this->ProdutoDTO->setIdProduto($id);
        $this->ProdutoDTO->setNome($nome);
        $this->ProdutoDTO->setDescricao($descricao);
        $this->ProdutoDTO->setPreco($preco);
        $this->ProdutoDTO->setQuantEmEstoque($quant_em_estoque);
        $numeroAleatorio = rand(100000, 999999);
        $this->ProdutoDTO->setCodDeBarra($numeroAleatorio);
        $this->ProdutoDTO->setIdfornecedor($idfornecedor);
        $this->ProdutoDTO->setIdcategoria($idcategoria);

        $this->ProdutoDAO->update($id, $this->ProdutoDTO);
        header("Location: ../view/admin/add_new_product.php");
    }

    public function getProdutoById($id) {
        // Aqui você pode implementar a lógica para obter os dados do Produto pelo ID
        $Produto = $this->ProdutoDAO->findById($id);
        return $Produto;
    }

    public function getTotalValue(){
        return $this->ProdutoDAO->totalValue();
    }

    public function getTotalProduct(){
        return $this->ProdutoDAO->totalProduct();
    }
    public function getSubTotalProduct($id){
        return $this->ProdutoDAO->subTotalProduct($id);
    } 

    public function excluirProduto($id) {
        $this->ProdutoDAO->delete($id);
        echo "Supplier deleted successfully.";
    }

    public function getAllProdutoes() {
        // Retorna todos os Produtoes
        $Produtoes = $this->ProdutoDAO->All();
        return $Produtoes;
    }
}

$ProdutoController = new ProdutoController();

if (isset($_POST['cadastrarproduct'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quant_em_estoque = $_POST['quant_em_estoque'];
    $idfornecedor = $_POST['idfornecedor'];
    $idcategoria = $_POST['idcategoria'];
    $ProdutoController->cadastrarProduto($nome, $descricao, $preco, $quant_em_estoque, $idfornecedor, $idcategoria);
    // Restante do código...
} elseif (isset($_POST['submit2'])) {
    $id = $_POST['id']; // Certifique-se de ter um campo hidden no seu formulário para armazenar o ID.
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quant_em_estoque = $_POST['quant_em_estoque'];
    $idfornecedor = $_POST['idfornecedor'];
    $idcategoria = $_POST['idcategoria'];
    $ProdutoController->editarProduto($id, $nome, $descricao, $preco, $quant_em_estoque, $idfornecedor, $idcategoria);
    // Restante do código...
}

?>
