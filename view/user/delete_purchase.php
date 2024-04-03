<?php
include_once("../../model/conect/DBConnection.php");
include_once("../../model/dto/CompraDTO.php");
include_once("../../model/dao/CompraDAO.php");

if (isset($_GET["idcompra"])) {
    $id = $_GET["idcompra"];

    try {
        // Cria uma instância do DAO de Compra
        $CompraDAO = new CompraDAO();

        // Obtém os dados do Compra pelo ID
        $Compra = $CompraDAO->getById($id);

        // Verifica se o Compra existe antes de tentar deletar
        if ($Compra) {
            // Deleta o Compra
            $CompraDAO->deletePurchase($id);

            // Redireciona de volta para a lista de Compraes após a exclusão
            header("Location: make_purchase.php");
            exit();
        } else {
            echo "Compra não encontrada.";
        }
    } catch (PDOException $e) {
        echo "Erro na exclusão do Compra: " . $e->getMessage();
    }
} else {
    echo "ID do Compra não fornecido.";
}
?>
