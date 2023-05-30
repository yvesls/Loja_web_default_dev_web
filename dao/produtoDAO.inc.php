<?php 
    require_once("../classes/Produto.inc.php");
    require_once("conexao.inc.php");
    require_once("../utils/utils.inc.php");

    class ProdutoDAO {
        private $con;

        public function __construct(){
            $conexao = new Conexao();
            $this->con = $conexao->getConexao();
        }
        
        public function incluirProduto($produto) {
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
        public function atualizarProduto($produto) {
            $query = 'UPDATE produtos SET nome = :nome, data_fabricacao = :data_fabricacao, preco = :preco, estoque = :estoque, descricao = :descricao, referencia = :referencia, cod_fabricante = :cod_fabricante where produto_id = :produto_id';
            $sql = $this->con->prepare($query);
            $sql->bindValue(':nome', $produto->getNome());
            $sql->bindValue(':data_fabricacao', converteDataMysql($produto->getDataFabricacao()));
            $sql->bindValue(':preco', $produto->getPreco());
            $sql->bindValue(':estoque', $produto->getEstoque());
            $sql->bindValue(':descricao', $produto->getDescricao());
            $sql->bindValue(':referencia', $produto->getReferencia());
            $sql->bindValue(':cod_fabricante', $produto->getFabricante());
            $sql->execute();
        }

        public function excluirProduto($produto_id) {
            $produto = $this->consultarProdutoPorId($produto_id);
            $query = 'DELETE * FROM produtos WHERE produto_id = :produto_id';
            $sql = $this->con->prepare($query);
            $sql->bindValue(':produto_id', $produto->produto_id);
            $sql->execute();
        }

        public function consultarProdutoPorId($produto_id) {
            $query = 'SELECT * FROM produtos WHERE produto_id = :produto_id';
            $sql = $this->con->prepare($query);
            $sql->bindValue(':produto_id', $produto_id);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_OBJ);
        }
    }