<?php 
    require_once("../classes/Produto.inc.php");
    require_once("/conexao.inc.php");
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
            $sql->execute();
        }

        public function excluirProduto($produto) {

        }

        public function consultarProduto($produto) {

        }
    }