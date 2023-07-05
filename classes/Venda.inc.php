<?php
class Venda {
    private $id_venda;
    private $cpf;
    private $valorTotal;
    private $dataVenda;

    function __construct($cpf, $valorTotal) {
        $this->cpf = $cpf;
        $this->valorTotal = $valorTotal;
        $this->dataVenda = time();
    }

    function getId() {
        return $this->id_venda;
    }
    function getCpf() {
        return $this->cpf;
    }
    function getValorTotal() {
        return $this->valorTotal;
    }
    function getData() {
        return $this->dataVenda;
    }

    function setId($id) {
        $this->id_venda = $id;
    }
    function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }
    function setData($data) {
        $this->dataVenda = $data;
    }
}
?>