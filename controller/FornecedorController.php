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

        if ($this->fornecedorDAO->create($this->fornecedorDTO)) {
            header("Location: ../view/admin/add_new_supplier.php");
        } else {
            $errorInfo = $this->conn->errorInfo();
            echo "Error inserting data: " . $errorInfo[2];
        }
    }

    public function editarFornecedor($id, $nome, $email, $telefone) {
        $fornecedor = $this->fornecedorDTO;
        $fornecedor->setId($id);
        $fornecedor->setNome($nome);
        $fornecedor->setEmail($email);
        $fornecedor->setTelefone($telefone);

        $this->fornecedorDAO->update($id, $fornecedor);
        header("Location: ../view/admin/add_new_supplier.php");
    }

    public function getFornecedorById($id) {
        // Aqui você pode implementar a lógica para obter os dados do fornecedor pelo ID
        $fornecedor = $this->fornecedorDAO->getById($id);
        return $fornecedor;
    }

    public function excluirFornecedor($id) {
        $this->fornecedorDAO->delete($id);
        echo "Supplier deleted successfully.";
    }

    public function getAllFornecedores() {
        // Retorna todos os fornecedores
        $fornecedores = $this->fornecedorDAO->getAll();
        return $fornecedores;
    }
}

$fornecedorController = new FornecedorController();

if (isset($_POST['cadastrarfornecedor'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $fornecedorController->cadastrarFornecedor($nome, $email, $telefone);
    // Restante do código...
} elseif (isset($_POST['submit'])) {
    $id = $_POST['id']; 
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $fornecedorController->editarFornecedor($id, $nome, $email, $telefone);
    // Restante do código...
}


