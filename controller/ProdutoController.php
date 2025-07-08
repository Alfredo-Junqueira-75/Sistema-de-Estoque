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

    public function cadastrarProduto($user, $nome, $descricao, $preco, $quant_em_estoque, $idfornecedor, $idcategoria) {
        $this->ProdutoDTO->setNome($nome);
        $this->ProdutoDTO->setDescricao($descricao);
        $this->ProdutoDTO->setPreco($preco);
        $this->ProdutoDTO->setQuantEmEstoque($quant_em_estoque);
        $numeroAleatorio = rand(100000, 999999);
        $this->ProdutoDTO->setCodDeBarra($numeroAleatorio);
        $this->ProdutoDTO->setIdfornecedor($idfornecedor);
        $this->ProdutoDTO->setIdcategoria($idcategoria);
        
        $creationResult = $this->ProdutoDAO->create($this->ProdutoDTO);
        error_log("Creation result for product " . $nome . ": " . ($creationResult ? "Success" : "Failure"));

        if ($creationResult) {
            if (!headers_sent()) {
                header("Location: ../view/".$user."/add_new_product.php");
                exit;
            } else {
                error_log("Headers already sent before redirection in cadastrarProduto.");
                echo "<div class=\"alert alert-success\">Product created successfully, but redirection failed.</div>";
            }
        } else {
            $errorInfo = $this->conn->errorInfo();
            error_log("Error inserting data for product " . $nome . ": " . $errorInfo[2]);
            echo "<div class=\"alert alert-danger\">Error inserting product.</div>";
        }
    }

    public function editarProduto($user, $id, $nome, $descricao, $preco, $quant_em_estoque, $idfornecedor, $idcategoria) {
        $this->ProdutoDTO->setIdProduto($id);
        $this->ProdutoDTO->setNome($nome);
        $this->ProdutoDTO->setDescricao($descricao);
        $this->ProdutoDTO->setPreco($preco);
        $this->ProdutoDTO->setQuantEmEstoque($quant_em_estoque);
        $numeroAleatorio = rand(100000, 999999);
        $this->ProdutoDTO->setCodDeBarra($numeroAleatorio);
        $this->ProdutoDTO->setIdfornecedor($idfornecedor);
        $this->ProdutoDTO->setIdcategoria($idcategoria);

        $updateResult = $this->ProdutoDAO->update($id, $this->ProdutoDTO);
        error_log("Update result for product ID " . $id . ": " . ($updateResult ? "Success" : "Failure"));

        if ($updateResult) {
            if (!headers_sent()) {
                header("Location: ../view/" . $user . "/add_new_product.php");
                exit;
            } else {
                error_log("Headers already sent before redirection in editarProduto.");
                echo "<div class=\"alert alert-success\">Product updated successfully, but redirection failed.</div>";
            }
        } else {
            $errorInfo = $this->conn->errorInfo();
            error_log("Error updating data for product ID " . $id . ": " . $errorInfo[2]);
            echo "<div class=\"alert alert-danger\">Error updating product.</div>";
        }
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
        $deleteResult = $this->ProdutoDAO->delete($id);
        error_log("Delete result for product ID " . $id . ": " . ($deleteResult ? "Success" : "Failure"));

        if ($deleteResult) {
            echo "<div class=\"alert alert-success\">Product deleted successfully.</div>";
        } else {
            $errorInfo = $this->conn->errorInfo();
            error_log("Error deleting product ID " . $id . ": " . $errorInfo[2]);
            echo "<div class=\"alert alert-danger\">Error deleting product.</div>";
        }
    }

    public function getAllProdutoes() {
        // Retorna todos os Produtoes
        $Produtoes = $this->ProdutoDAO->All();
        return $Produtoes;
    }
    public function handleRequest() {
        if (isset($_POST['cadastrarproduct'])) {
            $user = $_POST['user'];
            $nome = str_replace(' ', '_', $_POST['nome']);
            $descricao = $_POST['descricao'];
            $preco = $_POST['preco'];
            $quant_em_estoque = $_POST['quant_em_estoque'];
            $idfornecedor = $_POST['idfornecedor'];
            $idcategoria = $_POST['idcategoria'];
            $this->cadastrarProduto($user, $nome, $descricao, $preco, $quant_em_estoque, $idfornecedor, $idcategoria);
        } elseif (isset($_POST['submit2'])) {
            $user = $_POST['user'];
            $id = $_POST['id']; 
            $nome = str_replace(' ', '_', $_POST['nome']);
            $descricao = $_POST['descricao'];
            $preco = $_POST['preco'];
            $quant_em_estoque = $_POST['quant_em_estoque'];
            $idfornecedor = $_POST['idfornecedor'];
            $idcategoria = $_POST['idcategoria'];
            $this->editarProduto($user, $id, $nome, $descricao, $preco, $quant_em_estoque, $idfornecedor, $idcategoria);
        }
    }
}

$ProdutoController = new ProdutoController();
$ProdutoController->handleRequest();

?>
