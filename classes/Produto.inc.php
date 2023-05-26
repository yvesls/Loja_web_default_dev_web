<?php 
    class Produto {
        private $produto_id;
        private $nome;
        private $descricao;
        private $data_fabricacao;
        private $preco;
        private $estoque;
        private $referencia;
        private $fabricante;

        public function __construct(){
        }

        function setProduto($nome, $descricao, $data, $preco, $estoque, $referencia, $fabricante) {
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->data_fabricacao = strtotime(str_replace('/', '-',$data));
            $this->preco = $preco;
            $this->estoque = $estoque;
            $this->referencia = $referencia;
            $this->fabricante = $fabricante;
        }

        public function getNome($nome){
            return $this->$nome;
        }
        public function getDescricao($descricao){
            return $this->$descricao;
        }
        public function getDataFabricacao($data){
            return $this->$data;
        }
        public function getPreco($preco){
            return $this->$preco;
        }
        public function getEstoque($estoque){
            return $this->$estoque;
        }
        public function getFabricante($fabricante){
            return $this->$fabricante;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }   
        public function setDescricao($descricao){
            $this->nome = $descricao;
        }   
        public function setDataFabricacao($data){
            $this->data_fabricacao = strtotime($data);
        }   
        public function setPreco($preco){
            $this->preco = $preco;
        }  
        public function setEstoque($estoque){
            $this->estoque = $estoque;
        }   
        public function setReferencia($referencia){
            $this->referencia = $referencia;
        }
        public function setFabricante($fabricante){
            $this->fabricante = $fabricante;
        }   
    }

?>