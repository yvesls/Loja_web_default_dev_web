<?php
require_once("../classes/Produto.inc.php");
require_once("conexao.inc.php");
require_once("../utils/utils.inc.php");

class ProdutoDAO
{
    private $con;
    private $porPagina;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
        $this->porPagina = 10;
    }

    public function incluirProduto($produto)
    {
        $query = 'insert into produtos(nome, data_fabricacao, preco, estoque, descricao, referencia, cod_fabricante)values(:nome, :data_fabricacao, :preco, :estoque, :descricao, :referencia, :cod_fabricante)';
        $sql = $this->con->prepare($query);
        $sql->bindValue(':nome', $produto->getNome());
        $sql->bindValue(':data_fabricacao', converteDataMysql($produto->getDataFabricacao()));
        $sql->bindValue(':preco', $produto->getPreco());
        $sql->bindValue(':estoque', $produto->getEstoque());
        $sql->bindValue(':descricao', $produto->getDescricao());
        $sql->bindValue(':referencia', $produto->getReferencia());
        $sql->bindValue(':cod_fabricante', $produto->getFabricante());
        return $sql->execute();
    }
    public function atualizarProduto($produto)
    {
        $query = 'UPDATE produtos SET nome = :nome, preco = :preco, estoque = :estoque, descricao = :descricao, referencia = :referencia, cod_fabricante = :cod_fabricante where produto_id = :produto_id';
        $sql = $this->con->prepare($query);
        $sql->bindValue(':produto_id', $produto->getProdutoId());
        $sql->bindValue(':nome', $produto->getNome());
        $sql->bindValue(':preco', $produto->getPreco());
        $sql->bindValue(':estoque', $produto->getEstoque());
        $sql->bindValue(':descricao', $produto->getDescricao());
        $sql->bindValue(':referencia', $produto->getReferencia());
        $sql->bindValue(':cod_fabricante', $produto->getCodFabricante());
        $sql->execute();
    }

    public function excluirProduto($produto_id)
    {
        $query = 'DELETE FROM produtos WHERE produto_id = :produto_id';
        $sql = $this->con->prepare($query);
        $sql->bindValue(':produto_id', $produto_id);
        $sql->execute();
    }

    public function consultarProdutoPorId($produto_id)
    {
        $query = 'SELECT p.produto_id, p.nome, p.data_fabricacao, p.preco, p.estoque, p.descricao, p.referencia, f.nome nome_fabricante, p.cod_fabricante FROM produtos p INNER JOIN fabricantes f ON p.cod_fabricante = f.codigo WHERE produto_id = :produto_id';
        $sql = $this->con->prepare($query);
        $sql->bindValue(':produto_id', $produto_id);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_OBJ);
        $produto = new Produto();
        $produto->setProdutoId($row->produto_id);
        $produto->setNome($row->nome);
        $produto->setDescricao($row->descricao);
        $produto->setDataFabricacao($row->data_fabricacao);
        $produto->setPreco($row->preco);
        $produto->setEstoque($row->estoque);
        $produto->setReferencia($row->referencia);
        $produto->setFabricante($row->nome_fabricante);
        $produto->setCodFabricante($row->cod_fabricante);
        return $produto;
    }

    public function getProdutos()
    {
        $resultSet = $this->con->query('SELECT p.produto_id, p.nome, p.data_fabricacao, p.preco, p.estoque, p.descricao, p.referencia, f.nome nome_fabricante FROM produtos p INNER JOIN fabricantes f ON p.cod_fabricante = f.codigo');
        $lista = array();

        while ($row = $resultSet->fetch(PDO::FETCH_OBJ)) {
            $produto = new Produto();
            $produto->setProdutoId($row->produto_id);
            $produto->setNome($row->nome);
            $produto->setDescricao($row->descricao);
            $produto->setDataFabricacao($row->data_fabricacao);
            $produto->setPreco($row->preco);
            $produto->setEstoque($row->estoque);
            $produto->setReferencia($row->referencia);
            $produto->setFabricante($row->nome_fabricante);
            $produto->setCodFabricante($row->cod_fabricante);
            $lista[] = $produto;
        }
        return $lista;
    }

    public function getProdutosPaginacao($pagina)
    {
        $init = ($pagina - 1) * $this->porPagina;
        $resultSet = $this->con->query("SELECT p.produto_id, p.nome, p.data_fabricacao, p.preco, p.estoque, p.descricao, p.referencia, f.nome nome_fabricante FROM produtos p INNER JOIN fabricantes f ON p.cod_fabricante = f.codigo LIMIT $init, $this->porPagina");
        $lista = array();

        while ($row = $resultSet->fetch(PDO::FETCH_OBJ)) {
            $produto = new Produto();
            $produto->setProdutoId($row->produto_id);
            $produto->setNome($row->nome);
            $produto->setDescricao($row->descricao);
            $produto->setDataFabricacao($row->data_fabricacao);
            $produto->setPreco($row->preco);
            $produto->setEstoque($row->estoque);
            $produto->setReferencia($row->referencia);
            $produto->setFabricante($row->nome_fabricante);
            $lista[] = $produto;
        }
        return $lista;
    }

    public function getPagina()
    {
        $total_result = $this->con->query("SELECT count(*) as total FROM produtos")->fetch(PDO::FETCH_OBJ);
        $num_paginas = ceil($total_result->total / $this->porPagina);
        return $num_paginas;
    }
}
