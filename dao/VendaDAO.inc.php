<?php
require_once("conexao.inc.php");
require_once("../classes/Venda.inc.php");
require_once("../classes/Item.inc.php");
require_once("../utils/utils.inc.php");
class VendaDAO {
    private $conn;
    public function __construct()
    {
        $c = new Conexao();
        $this->conn = $c->getConexao();
    }
    public function incluirVenda(Venda $venda, $carrinho){
        $sql = $this->conn->prepare("INSERT INTO vendas (
            cpf_cliente, 
            dataVenda, 
            valorTotal
        ) VALUES (
            :cpf, 
            :data_venda, 
            :valor
        )");
        $sql->bindValue(":cpf", $venda->getCpf());
        $sql->bindValue(":data_venda", converteDataMySQL($venda->getData()));
        $sql->bindValue(":valor", $venda->getValorTotal());
        $sql->execute();

        $id = $this->getIdUltimaVenda();

        $this->incluirItens($id, $carrinho);
    }

    private function incluirItens($idVenda, $carrinho){
        $id_item = 1;

        foreach ($carrinho as $item) {
            $sql = $this->conn->prepare("INSERT INTO itens (
                id_produto,
                id_item,
                quantidade,
                valorTotal,
                id_venda
            )
            VALUES (
                :prod,
                :id,
                :qtd,
                :val,
                :ven
            )");

            $sql->bindValue(":prod", $item->getProduto()->getProdutoId());
            $sql->bindValue(":id", $id_item);
            $sql->bindValue(":qtd", $item->getQuantidade());
            $sql->bindValue(":val", $item->getValorItem());
            $sql->bindValue(":ven", $idVenda);
            $sql->execute();
            $id_item++;
        }
    }

    private function getIdUltimaVenda(){
        $sql = $this->conn->query("SELECT MAX(id_venda) AS maior FROM vendas");
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_OBJ);

        return $row->maior;
    }
}
?>