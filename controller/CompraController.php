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

        $purchaseResult = $this->compraDAO->purchase($this->compraDTO);
        error_log("Purchase result for client " . $cliente . ": " . ($purchaseResult ? "Success" : "Failure"));

        if ($purchaseResult) {
            if (!headers_sent()) {
                header("Location: ../view/user/make_purchase.php");
                exit;
            } else {
                error_log("Headers already sent before redirection in realizarCompra.");
                echo "<div class=\"alert alert-success\">Purchase completed successfully, but redirection failed.</div>";
            }
        } else {
            $errorInfo = $this->conn->errorInfo();
            error_log("Error inserting data for purchase by " . $cliente . ": " . $errorInfo[2]);
            echo "<div class=\"alert alert-danger\">Error completing purchase.</div>";
        }

    }

}

    public function handleRequest(){
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

            $this->realizarCompra($cliente, $produtos, $totalPrice);

        }
    }

}

$compraController = new CompraController();
$compraController->handleRequest();