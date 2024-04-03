<?php

    class CompraDTO{
        private $id;
        private $cliente;
        private $produtos;
        private $data;
        private $idusuario;
        private $preco_total;

        public function __construct(){}

        public function getId(){return $this->id;}
        public function setId($id){$this->id = $id;}
        public function getCliente(){return $this->cliente;}
        public function setCliente($cliente){$this->cliente = $cliente;}
        public function getProdutos(){return $this->produtos;}
        public function setProdutos($produtos){$this->produtos = $produtos;}
        public function getData(){return $this->data;}
        public function setData($data){$this->data = $data;}
        public function getIdUsuario(){return $this->idusuario;}
        public function setIdUsuario($idusuario){$this->idusuario = $idusuario;}
        public function getPrecoTotal(){return $this->preco_total;}
        public function setPrecoTotal($preco_total){$this->preco_total = $preco_total;}

    }

