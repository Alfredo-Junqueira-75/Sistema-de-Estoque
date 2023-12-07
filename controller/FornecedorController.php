<?php

include_once("../model/conect/DBConnection.php");
include_once("../model/dto/FornecedorDTO.php");
include_once("../model/dao/FornecedorDAO.php");

$FornecedorDTO = new FornecedorDTO();
$FornecedorDAO = new FornecedorDAO();

if(isset($_POST)){
    $FornecedorDTO->setName($_POST["name"]);
    $FornecedorDTO->setEmail($_POST["email"]);
    $FornecedorDTO->setTelefone($_POST["telefone"]);

    if($FornecedorDAO->create($FornecedorDTO)){
        echo "dados insiridos com sucesso";
    }
}

