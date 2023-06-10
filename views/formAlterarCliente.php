<?php
require_once 'includes/cabecalho.inc.php';
require_once '../classes/Cliente.inc.php';

session_start();
$cliente = $_SESSION["cliente"];
if (isset($_REQUEST["erro"])) {
    if ((int)($_REQUEST["erro"]) == 1) {
        echo ("<b><font face='Verdana' size='2' color='red'>" . $_SESSION['erro1'] . "</font></b>");
    }
}
?>
<form align="center" action="../controllers/controllerCliente.php" method="POST">
    <h2>Editar Cliente</h2><br><br>
    <label for="cpf">CPF:</label>
    <input type="text" disabled value="<?= $cliente->getCPF() ?>"><br><br>
    <input type="hidden" id="cpf" name="cpf" value="<?= $cliente->getCPF() ?>">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?= $cliente->getNome() ?>"><br><br>

    <label for="logradouro">Logradouro:</label>
    <input type="text" id="logradouro" name="logradouro" value="<?= $cliente->getLogradouro() ?>"><br><br>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" value="<?= $cliente->getCidade() ?>"><br><br>

    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" value="<?= $cliente->getEstado() ?>"><br><br>

    <label for="cep">CEP:</label>
    <input type="text" id="cep" name="cep" value="<?= $cliente->getCep() ?>"><br><br>

    <label for="telefone">Telefone:</label>
    <input type="text" id="telefone" name="telefone" value="<?= $cliente->getTelefone() ?>"><br><br>

    <!-- <label for="data_nascimento">Data de Nascimento:</label>
    <input type="text" id="data_nascimento" name="data_nascimento" value="<?= $cliente->getDataNascimento() ?>"><br><br> -->

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= $cliente->getEmail() ?>"><br><br>

    <label for="rg">RG:</label>
    <input type="text" id="rg" name="rg" value="<?= $cliente->getRG() ?>"><br><br>
    <input type="hidden" name="opcao" value="alterar">
    <input type="submit" value="Registrar"><input type="reset" value="Cancelar">
</form>

<?php
require_once 'includes/rodape.inc.php';
?>