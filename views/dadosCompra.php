<?php
require_once 'includes/cabecalho.inc.php';
require_once '../classes/Item.inc.php';
require_once '../utils/utils.inc.php';
require_once '../classes/Cliente.inc.php';
session_start();
$cliente = $_SESSION["cliente"];
$total = $_SESSION["total"];
$carrinho = $_SESSION["carrinho"];
?>

<center>
    <h1>Dados da compra</h1>
    <table border="0" cellspacing="2" width="60%">
        <tr bgcolor="#000098" align="center">

            <th>
                <font face="Verdana" size="2" color="#FFFFFF">
                    <font face="Verdana" size="2">Item No</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Ref.</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Nome</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Fabricante</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Quantidade</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Valor produto</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Total produto</font>
            </th>
        </tr>
        <?php
        $i = 1;
        foreach ($carrinho as $item) {
        ?>
            <tr align="center">
                <td>
                    <font face="Verdana" size="2"><?= $i++ ?></font>
                </td>
                <td>
                    <font face="Verdana" size="2"><?= $item->getProduto()->getProdutoId() ?> </font>
                </td>
                <td>
                    <font face="Verdana" size="2"><?= $item->getProduto()->getNome() ?></font>
                </td>
                <td>
                    <font face="Verdana" size="2"><?= $item->getProduto()->getFabricante() ?></font>
                </td>
                <td>
                    <font face="Verdana" size="2"><?= $item->getQuantidade() ?></font>
                </td>
                <td>
                    <font face="Verdana" size="2"><?= $item->getProduto()->getPreco() ?> R$</font>
                </td>
                <td>
                    <font face="Verdana" size="2"><?= $item->getValorItem() ?> R$</font>
                </td>
            </tr>
        <?php
        }
        ?>
        <tr align="right">
            <td colspan="7">
                <font face="Verdana" size="4" color="red"><b>Valor Total = R$ <?= $total ?></b></font>
            </td>
        </tr>
    </table>
    <p>
        <hr width="50%">
        <img src="imagens/espaco.png" border="0">
    <p>
    <h1>Dados do cliente</h1>
    <table border="0" cellspacing="2" width="60%">
        <tr bgcolor="#000098" align="center">
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">CPF</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Nome</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Logradouro</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Cidade</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Estado</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">CEP</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Telefone</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Data de Nascimento</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">Email</font>
            </th>
            <th>
                <font face="Verdana" size="2" color="#FFFFFF">RG</font>
            </th>
        </tr>
        <tr>
            <td><?= $cliente->getCPF() ?></td>
            <td><?= $cliente->getNome() ?></td>
            <td><?= $cliente->getLogradouro() ?></td>
            <td><?= $cliente->getCidade() ?></td>
            <td><?= $cliente->getEstado() ?></td>
            <td><?= $cliente->getCEP() ?></td>
            <td><?= $cliente->getTelefone() ?></td>
            <td><?= formatarData($cliente->getDataNascimento()) ?></td>
            <td><?= $cliente->getEmail() ?></td>
            <td><?= $cliente->getRG() ?></td>

        </tr>
    </table>
    <p>
        <hr width="50%">
        <img src="imagens/espaco.png" border="0">
    <p>
    <div align="center">
        <button style="padding: 5px 10px; background-color: blue;">
            <font face="Verdana" size="2" color="Orange">Pagar</font>
        </button>

    </div>
</center>
<?php
require_once 'includes/rodape.inc.php';
?>