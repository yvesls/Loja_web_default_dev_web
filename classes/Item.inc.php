<?php
require_once "Produto.inc.php";
class Item
{
    private Produto $produto;
    private $quantidade;
    private $valorItem;

    function __construct($produto)
    {
        $this->produto = $produto;
        $this->quantidade = 1;
        $this->valorItem = $produto->getPreco();
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade()
    {
        $this->quantidade += 1;
    }

    public function getValorItem()
    {
        return $this->valorItem;
    }

    public function setValorItem()
    {
        $this->valorItem = $this->quantidade * $this->produto->getPreco();
    }

    public function getProduto()
    {
        return $this->produto;
    }
}
