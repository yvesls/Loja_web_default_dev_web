<?php
    class Fabricante {
        private $fabricante_id;
        private $nome;
        private $logradouro;
        private $cep;
        private $cidade;
        private $email;
        private $ramo;

        public function __construct(){
        }

        function setProduto($nome, $logradouro, $cep, $cidade, $email, $ramo) {
            $this->nome = $nome;
            $this->logradouro = $logradouro;
            $this->cep = $cep;
            $this->cidade = $cidade;
            $this->email = $email;
            $this->ramo = $ramo;
        }
        public function getFabricanteId(){
            return $this->fabricante_id;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getLogradouro(){
            return $this->logradouro;
        }
        public function getCep(){
            return $this->cep;
        }
        public function getCidade(){
            return $this->cidade;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getRamo(){
            return $this->ramo;
        }
        public function setFabricanteId($fabricante_id){
            $this->fabricante_id = $fabricante_id;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }
        public function setLogradouro($logradouro){
            $this->logradouro = $logradouro;
        }
        public function setCep($cep){
            $this->cep = $cep;
        }
        public function setCidade($cidade){
            $this->cidade = $cidade;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function setRamo($ramo){
            $this->ramo = $ramo;
        }
    }
?>