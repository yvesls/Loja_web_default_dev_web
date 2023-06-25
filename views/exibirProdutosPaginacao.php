<?php
require_once 'includes/cabecalho.inc.php';
require_once '../utils/utils.inc.php';
require_once '../classes/Produto.inc.php';
session_start();
$listaProdutos = $_SESSION["produtos"];
$paginas = $_REQUEST["paginas"];
?>

<div align="center">
    <h1>Exibir Produtos</h1>
</div>
<div align="center" style="padding: 50px 0px;">
    <table border="1" cellspacing="2" cellpadding="5" width="80%">
        <tr>
            <th witdh="10%">ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Data de Fabricação</th>
            <th>Preço unitário</th>
            <th>Em Estoque</th>
            <th>Fabricante</th>
            <th>Operação</th>
        </tr>
        <?php
        foreach ($listaProdutos as $produto) {
            // fazer a logica de exibição dos produtos
        ?>
            <td><?= $produto->getProdutoId() ?></td>
            <td><?= $produto->getNome() ?></td>
            <td><?= $produto->getDescricao() ?></td>
            <td><?= formatarData($produto->getDataFabricacao()) ?></td>
            <td><?= $produto->getPreco() ?></td>
            <td><?= $produto->getEstoque() ?></td>
            <td><?= $produto->getFabricante() ?></td>
            <td><?= $produto->getReferencia() ?></td>

        <?php
            echo "<td><a href='../controllers/controllerProduto.php?opcao=buscarPorId&id=" . $produto->getProdutoId() . "''>Alterar</a>&nbsp;";
            echo "<td><a href='../controllers/controllerProduto.php?opcao=excluir&id=" . $produto->getProdutoId() . "'>Excluir</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <div align="center">
        <?php
        for ($i = 1; $i <= $paginas; $i++) {

        ?>
            <a href="../controllers/controllerProduto.php?opcao=porPagina&pagina=<?= $i ?>"><?= $i ?></a>
        <?php
        }
        ?>
    </div>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>