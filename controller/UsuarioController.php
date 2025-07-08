<?php


include_once(__DIR__ . "/../model/dao/UsuarioDAO.php");
include_once(__DIR__ . "/../model/dto/UsuarioDTO.php");

class UsuarioController {
    private $usuarioDAO;
    private $usuarioDTO;
    private $conn;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
        $this->usuarioDTO = new UsuarioDTO();
        $this->conn = $this->usuarioDAO->getConn();
    }

    public function validarLogin($username, $password, $role) {
        error_log("Attempting login for username: " . $username . ", role: " . $role);
        if ($this->usuarioDAO->validarLogin($username, $password, $role)) {
            error_log("Login successful for username: " . $username);
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $role;
            if ($role == 'admin') {
                header("Location: ../view/admin/demo.php");
            } else {
                header("Location: ../view/user/demo.php");
            }
            exit;
        } else {
            error_log("Login failed for username: " . $username . ", role: " . $role);
            echo '<div class="alert alert-danger">Invalid Username or Password, or account blocked by admin.</div>';
        }
    }

    public function cadastrarUsuario($username, $password, $role) {
        $this->usuarioDTO->setUsername($username);
        $this->usuarioDTO->setPassword($password);
        $this->usuarioDTO->setRole($role);
        $this->usuarioDTO->setStatus("active");

        $creationResult = $this->usuarioDAO->create($this->usuarioDTO);
        error_log("Creation result for user " . $username . ": " . ($creationResult ? "Success" : "Failure"));

        if ($creationResult) {
            if (!headers_sent()) {
                header("Location: ../view/admin/add_new_user.php");
                exit;
            } else {
                error_log("Headers already sent before redirection in cadastrarUsuario.");
                echo "<div class=\"alert alert-success\">User created successfully, but redirection failed.</div>";
            }
        } else {
            $errorInfo = $this->conn->errorInfo();
            error_log("Error inserting data for user " . $username . ": " . $errorInfo[2]);
        }
    }

    public function editarUsuario($id, $password, $role, $status) {
        $this->usuarioDTO->setIdusuario($id);
        $this->usuarioDTO->setPassword($password);
        $this->usuarioDTO->setRole($role);
        $this->usuarioDTO->setStatus($status);

        $this->usuarioDAO->updateUsuario($this->usuarioDTO);
        header("Location: ../view/admin/add_new_user.php");
    }

    public function getUsuarioById($id) {
        // Aqui você pode implementar a lógica para obter os dados do usuário pelo ID
        $usuario = $this->usuarioDAO->getUsuarioById($id);
        return $usuario;
    }
}

$usuarioController = new UsuarioController();

if (isset($_POST['submit1'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usuarioController->validarLogin($username, $password, 'user');
} elseif (isset($_POST['submit2'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usuarioController->validarLogin($username, $password, 'admin');
} elseif (isset($_POST['submit3'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $usuarioController->cadastrarUsuario($username, $password, $role);
    // Restante do código...
} elseif (isset($_POST['submit4'])) {
    $id = $_POST['id']; // Certifique-se de ter um campo hidden no seu formulário para armazenar o ID.
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $usuarioController->editarUsuario($id, $password, $role, $status);
    // Restante do código...
}

?>