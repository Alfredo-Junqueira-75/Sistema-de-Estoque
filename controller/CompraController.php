<?php

include_once( __DIR__ ."/../model/dao/CompraDAO.php");
include_once( __DIR__ ."/../model/dto/CompraDTO.php");


class CompraController{
    private $compraDAO;
    private $compraDTO;
    private $conn;

    public function __construct(){
        $this->compraDAO = new CompraDAO();
        $this->compraDTO = new CompraDTO();
        $this->conn = $this->compraDAO->getConn();
    }

    public function realizarCompra($cliente, $produtos, $totalPrice){
        $this->compraDTO->setCliente($cliente);
        $this->compraDTO->setProdutos($produtos);
        $this->compraDTO->setData(date("Y-m-d"));
        $this->compraDTO->setIdUsuario(600);
        $this->compraDTO->setPrecoTotal($totalPrice);

        if ($this->compraDAO->purchase($this->compraDTO)) {
            header("Location: ../view/user/make_purchase.php");
        } else {
            $errorInfo = $this->conn->errorInfo();
            echo "Error inserting data: " . $errorInfo[2];
        }

    }

}

$compraController = new CompraController();

if(isset($_POST['finalizarComprar'])){

    $cliente = $_POST['cliente'];
    $produtos = "";
    $totalPrice = 0;

    include_once( __DIR__ ."/../model/dao/ProdutoDAO.php");
    $ProdutoDAO = new ProdutoDAO();

    foreach ($ProdutoDAO->All() as $row) {
        $nomeInput = $row["nome"];

        if (isset($_POST[$nomeInput])) {
            $valorInput = $_POST[$nomeInput];
            if($valorInput != 0){
                $ProdutoDAO->reduceQuant($valorInput, $nomeInput);
                $produtos .= $nomeInput. "(". $valorInput. ")". "; ";
                $totalPrice += $ProdutoDAO->getPriceByName($nomeInput);
            }
        }
    }

    $compraController->realizarCompra($cliente, $produtos, $totalPrice);

}