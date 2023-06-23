<?php
require_once 'includes/cabecalho.inc.php';
require_once '../classes/Produto.inc.php';
session_start();
$listaProdutos = $_SESSION["produtos"];
?>

<center>
    <h1>Produtos cadastrados</h1>
    <p>
    <div align="right" style="position: fixed; right: 0;">
        <a href="exibirCarrinho.php"><img src="imagens/meu-carrinho.png" alt="carrinho de compras"></a>
    </div>

    <?php foreach ($listaProdutos as $produto) { ?>
        <table border="0" width="30%" cellspacing="10">
            <tr>
                <td rowspan="5" align="center"><img src="imagens/produtos/<?= $produto->getReferencia() ?>.jpg" width="200" height="200" border="0"></td>
            </tr>
            <tr align="left">
                <td colspan="2"><b>
                        <font face="Verdana" size="3"> <?= $produto->getNome() ?> </font>
                    </b></td>
            </tr>
            <tr>
                <td style="text-align:justify" colspan="2">
                    <font face="Verdana" size="2"> <?= $produto->getDescricao() ?></font>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <font face="Verdana" size="2"><b>Fabricante:</b> <?= $produto->getFabricante() ?></font>
                </td>
            </tr>
            <tr>
                <td><b>
                        <font face="Verdana" size="3" color="red">
                            <font color="black">Valor: </font>R$ <?= $produto->getPreco() ?>
                        </font>
                    </b></td>
                <td colspan="2"><a href="../controllers/controllerCarrinho.php?opcao=inserir&id=<?= $produto->getProdutoId() ?>"><img src='imagens/botao_comprar2.png' border='0'></a></td>
            </tr>
        </table>
        <p>
            <hr width="30%">
        <p>
        <?php
    }
    require_once 'includes/rodape.inc.php';
        ?>