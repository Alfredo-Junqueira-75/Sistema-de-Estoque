<?php

include_once("../model/conect/DBConnection.php");
include_once("../model/dao/UsuarioDAO.php");
include_once("../model/dto/UsuarioDTO.php");

$usuarioDAO = new UsuarioDAO();
$conn = $usuarioDAO->getConn();

if(isset($_POST['submit1'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $count = $usuarioDAO->validarUsuario($username, $password);
    
    if($count>0){
        ?>
    <script type="text/javascript">
        console.log("Redirecionando para demo.php");
        window.location="../view/demo.php"
    </script>
        <?php
    }else{
        ?>
        <div class="alert alert-danger">Invalide Username or Password, or account blocked by admin.

        </div>
    <?php
    }
}

if(isset($_POST['submit2'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $count = $usuarioDAO->validarAdmin($username, $password);
    
    if($count>0){
        ?>
    <script type="text/javascript">
        console.log("Redirecionando para demo.php");
        window.location="../view/demo.php"
    </script>
        <?php
    }else{
        ?>
        <div class="alert alert-danger">Invalide Username or Password.

        </div>
    <?php
    }
}


?>