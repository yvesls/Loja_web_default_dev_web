<?php
require_once 'includes/cabecalho.inc.php';
require_once '../utils/utils.inc.php';
require_once '../classes/Cliente.inc.php';
session_start();
$listaClientes = $_SESSION["clientes"];
?>

<div align="center">
    <h1>Exibir Clientes</h1>
</div>
<div align="center" style="padding: 50px 0px;">
    <table border="1" cellspacing="2" cellpadding="5" width="80%">
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Logradouro</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>CEP</th>
            <th>Telefone</th>
            <th>Data de Nascimento</th>
            <th>Email</th>
            <th>RG</th>
        </tr>
        <?php
        foreach ($listaClientes as $cliente) {
            // fazer a logica de exibição dos produtos
        ?>
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
        <?php
            echo "<td><a href='../controllers/controllerCliente.php?opcao=buscarPorId&id=" . $cliente->getCPF() . "''>Alterar</a>&nbsp;";
            echo "<td><a href='../controllers/controllerCliente.php?opcao=excluir&id=" . $cliente->getCPF() . "'>Excluir</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>