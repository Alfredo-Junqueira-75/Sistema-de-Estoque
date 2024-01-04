<?php
include_once("../../model/conect/DBConnection.php");
include_once("../../model/dto/UsuarioDTO.php");
include_once("../../model/dao/UsuarioDAO.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    try {
        // Cria uma instância do DAO de usuário
        $usuarioDAO = new UsuarioDAO();

        // Obtém os dados do usuário pelo ID
        $usuario = $usuarioDAO->getUsuarioById($id);

        // Verifica se o usuário existe antes de tentar deletar
        if ($usuario) {
            // Deleta o usuário
            
            $usuarioDAO->deleteUsuario($id);

            // Redireciona de volta para a lista de usuários após a exclusão
            header("Location: add_new_user.php");
            exit();
        } else {
            echo "Usuário não encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro na exclusão do usuário: " . $e->getMessage();
    }
} else {
    echo "ID do usuário não fornecido.";
}
?>