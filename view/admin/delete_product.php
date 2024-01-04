<?php
include_once("../../model/conect/DBConnection.php");
include_once("../../model/dto/ProdutoDTO.php");
include_once("../../model/dao/ProdutoDAO.php");

if (isset($_GET["idproduto"])) {
    $id = $_GET["idproduto"];

    try {
        // Cria uma instância do DAO de Produto
        $ProdutoDAO = new ProdutoDAO();

        // Obtém os dados do Produto pelo ID
        $Produto = $ProdutoDAO->findById($id);

        // Verifica se o Produto existe antes de tentar deletar
        if ($Produto) {
            // Deleta o Produto
            
            $ProdutoDAO->delete($id);

            // Redireciona de volta para a lista de Produtos após a exclusão
            header("Location: add_new_product.php");
            exit();
        } else {
            echo "Produto não encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro na exclusão do Produto: " . $e->getMessage();
    }
} else {
    echo "ID do Produto não fornecido.";
}
?>