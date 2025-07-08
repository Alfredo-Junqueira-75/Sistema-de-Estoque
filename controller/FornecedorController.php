<?php

include_once(__DIR__ . "/../model/dao/FornecedorDAO.php");
include_once(__DIR__ . "/../model/dto/FornecedorDTO.php");

class FornecedorController {
    private $fornecedorDAO;
    private $fornecedorDTO;
    private $conn;

    public function __construct() {
        $this->fornecedorDAO = new FornecedorDAO();
        $this->fornecedorDTO = new FornecedorDTO();
        $this->conn = $this->fornecedorDAO->getConn();
    }

    public function cadastrarFornecedor($nome, $email, $telefone) {
        $this->fornecedorDTO->setNome($nome);
        $this->fornecedorDTO->setEmail($email);
        $this->fornecedorDTO->setTelefone($telefone);

        $creationResult = $this->fornecedorDAO->create($this->fornecedorDTO);
        error_log("Creation result for supplier " . $nome . ": " . ($creationResult ? "Success" : "Failure"));

        if ($creationResult) {
            if (!headers_sent()) {
                header("Location: ../view/admin/add_new_supplier.php");
                exit;
            } else {
                error_log("Headers already sent before redirection in cadastrarFornecedor.");
                echo "<div class=\"alert alert-success\">Supplier created successfully, but redirection failed.</div>";
            }
        } else {
            $errorInfo = $this->conn->errorInfo();
            error_log("Error inserting data for supplier " . $nome . ": " . $errorInfo[2]);
            echo "<div class=\"alert alert-danger\">Error inserting supplier.</div>";
        }
    }

    public function editarFornecedor($id, $nome, $email, $telefone) {
        $fornecedor = $this->fornecedorDTO;
        $fornecedor->setId($id);
        $fornecedor->setNome($nome);
        $fornecedor->setEmail($email);
        $fornecedor->setTelefone($telefone);

        $updateResult = $this->fornecedorDAO->update($id, $fornecedor);
        error_log("Update result for supplier ID " . $id . ": " . ($updateResult ? "Success" : "Failure"));

        if ($updateResult) {
            if (!headers_sent()) {
                header("Location: ../view/admin/add_new_supplier.php");
                exit;
            } else {
                error_log("Headers already sent before redirection in editarFornecedor.");
                echo "<div class=\"alert alert-success\">Supplier updated successfully, but redirection failed.</div>";
            }
        } else {
            $errorInfo = $this->conn->errorInfo();
            error_log("Error updating data for supplier ID " . $id . ": " . $errorInfo[2]);
            echo "<div class=\"alert alert-danger\">Error updating supplier.</div>";
        }
    }

    public function getFornecedorById($id) {
        // Aqui você pode implementar a lógica para obter os dados do fornecedor pelo ID
        $fornecedor = $this->fornecedorDAO->getById($id);
        return $fornecedor;
    }

    public function excluirFornecedor($id) {
        $deleteResult = $this->fornecedorDAO->delete($id);
        error_log("Delete result for supplier ID " . $id . ": " . ($deleteResult ? "Success" : "Failure"));

        if ($deleteResult) {
            echo "<div class=\"alert alert-success\">Supplier deleted successfully.</div>";
        } else {
            $errorInfo = $this->conn->errorInfo();
            error_log("Error deleting supplier ID " . $id . ": " . $errorInfo[2]);
            echo "<div class=\"alert alert-danger\">Error deleting supplier.</div>";
        }
    }

    public function getAllFornecedores() {
        // Retorna todos os fornecedores
        $fornecedores = $this->fornecedorDAO->getAll();
        return $fornecedores;
    }
public function handleRequest() {
        if (isset($_POST['cadastrarfornecedor'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $this->cadastrarFornecedor($nome, $email, $telefone);
        } elseif (isset($_POST['submit'])) {
            $id = $_POST['id']; 
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $this->editarFornecedor($id, $nome, $email, $telefone);
        }
    }
}

$fornecedorController = new FornecedorController();
$fornecedorController->handleRequest();

?>


