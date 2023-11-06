<?php 

class ProdutoDTO{
    private $idProduto;
    private $nome;
    private $descricao;
    private $preco;
    private $quant_em_estoque;
    private $cod_de_barra;
    private $idfornecedor;

    public function __construct(){}

    public function getIdProduto(){return $this->idProduto;}
    public function setIDProduto($idProduto){$this->idProduto=$idProduto;}
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome=$nome;}
    public function getDescricao(){return $this->descricao;}
    public function setDescricao($descricao){$this->descricao=$descricao;}
    public function getPreco(){return $this->preco;}
    public function setPreco($preco){$this->preco=$preco;}
    public function getQuantEmEstoque(){return $this->quant_em_estoque;}
    public function setQuantEmEstoque($quant_em_estoque){$this->quant_em_estoque=$quant_em_estoque;}
    public function getCodDeBarra(){return $this->cod_de_barra;}
    public function setCodDeBarra($cod_de_barra){$this->cod_de_barra=$cod_de_barra;}
    public function getIdfornecedor(){return $this->idfornecedor;}
    public function setIdfornecedor($idfornecedor){$this->idfornecedor=$idfornecedor;}
    
}

?>