<?php 

include_once("../model/conect/DBConnection.php");
include_once("../model/dao/ProdutoDAO.php");
include_once("../model/dto/ProdutoDTO.php");

$produtoDTO = new ProdutoDTO();
$produtoDAO = new ProdutoDAO();


if (isset($_POST)) {
    $produtoDTO->setNome($_POST["nome"]);
    $produtoDTO->setDescricao($_POST["descricao"]);
    $produtoDTO->setPreco($_POST["preco"]);
    $produtoDTO->setQuantEmEstoque($_POST["quant_em_estoque"]);
    $produtoDTO->setCodDeBarra($_POST["cod_de_barra"]);
    $produtoDTO->setIdfornecedor($_POST["idfornecedor"]);

    if ($produtoDAO->create($produtoDTO)) {
        echo "Dados inseridos com sucesso.";
    } else {
        $conn = $produtoDAO->getConn();
        echo "Erro na inserção de dados: " . $conn->error;
    }
}

$products = $produtoDAO->all();
include_once("../view/produto.php");

?>

