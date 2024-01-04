<?php
include_once("../../model/conect/DBConnection.php");
include_once("../../model/dto/FornecedorDTO.php");
include_once("../../model/dao/FornecedorDAO.php");

if (isset($_GET["idfornecedor"])) {
    $id = $_GET["idfornecedor"];

    try {
        // Cria uma instância do DAO de fornecedor
        $fornecedorDAO = new FornecedorDAO();

        // Obtém os dados do fornecedor pelo ID
        $fornecedor = $fornecedorDAO->getById($id);

        // Verifica se o fornecedor existe antes de tentar deletar
        if ($fornecedor) {
            // Deleta o fornecedor
            $fornecedorDAO->delete($id);

            // Redireciona de volta para a lista de fornecedores após a exclusão
            header("Location: add_new_supplier.php");
            exit();
        } else {
            echo "Fornecedor não encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro na exclusão do fornecedor: " . $e->getMessage();
    }
} else {
    echo "ID do fornecedor não fornecido.";
}
?>
