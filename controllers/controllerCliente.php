<?php
require_once("../classes/Cliente.inc.php");
require_once("../dao/clienteDAO.php");

$opcao = $_REQUEST['opcao'];


function validate($tipo)
{
    if ($tipo == "alterar") {
        $camposObrigatorios = array(
            'cpf',
            'nome',
            'logradouro',
            'cidade',
            'estado',
            'cep',
            'telefone',
            'email',
            'rg'
        );
    } else {
        $camposObrigatorios = array(
            'cpf',
            'nome',
            'logradouro',
            'cidade',
            'estado',
            'cep',
            'telefone',
            'data_nascimento',
            'email',
            'senha',
            'rg'
        );
    }

    $camposVazios = array();

    foreach ($camposObrigatorios as $campo) {
        if (empty($_POST[$campo])) {
            $camposVazios[] = $campo;
        }
    }

    if (!empty($camposVazios)) {
        $mensagemErro = 'Os seguintes campos estão vazios: ' . implode(', ', $camposVazios);
        return $mensagemErro;
    }

    return null;
}

function inserirCliente()
{
    $cliente = new Cliente();
    $cliente->setCPF($_POST['cpf']);
    $cliente->setNome($_POST['nome']);
    $cliente->setLogradouro($_POST['logradouro']);
    $cliente->setCidade($_POST['cidade']);
    $cliente->setEstado($_POST['estado']);
    $cliente->setTelefone($_POST['telefone']);
    $cliente->setCEP($_POST['cep']);
    $cliente->setDataNascimento($_POST['data_nascimento']);
    $cliente->setEmail($_POST['email']);
    $cliente->setSenha($_POST['senha']);
    $cliente->setRG($_POST['rg']);
    $dao = new ClienteDAO();
    if (!$dao->inserirCliente($cliente)) {
        header("Location:../views/formCliente.php?erro=1");
        return;
    }
    header('Location: ../views/formCliente.php?inclusao=1');
}

if ($opcao == "cadastrar") {
    $retorno_verificacao = validate("incluir");
    if ($retorno_verificacao == null) {
        inserirCliente();
    } else {
        session_start();
        $_SESSION['erro2'] = $retorno_verificacao;
        header("Location:../views/formCliente.php?erro=2");
    }
}


if ($opcao == "exibirTodos") {
    $clienteDAO = new ClienteDAO();
    $listaClientes = $clienteDAO->getClientes();
    session_start();
    $_SESSION["clientes"] = $listaClientes;

    header("Location: ../views/exibirClientes.php");
}

if ($opcao == "excluir") {
    $id = $_REQUEST['id'];
    $clienteDAO = new ClienteDAO();
    $clienteDAO->excluirCliente($id);
    header('Location: controllers/../controllerCliente.php?opcao=exibirTodos');
}
if ($opcao == "buscarPorId") {
    $cpf = $_REQUEST['id'];
    $clienteDAO = new ClienteDAO();
    $cliente = $clienteDAO->consultarClientePorId($cpf);
    session_start();
    $_SESSION["cliente"] = $cliente;
    header('Location: ../views/formAlterarCliente.php');
}

if ($opcao == "alterar") {
    $retorno_verificacao = validate("alterar");
    if ($retorno_verificacao == null) {
        $cliente = new Cliente();
        $cliente->setCPF($_POST['cpf']);
        $cliente->setNome($_POST['nome']);
        $cliente->setLogradouro($_POST['logradouro']);
        $cliente->setCidade($_POST['cidade']);
        $cliente->setEstado($_POST['estado']);
        $cliente->setTelefone($_POST['telefone']);
        $cliente->setCEP($_POST['cep']);
        $cliente->setDataNascimento($_POST['data_nascimento']);
        $cliente->setEmail($_POST['email']);
        $cliente->setSenha($_POST['senha']);
        $cliente->setRG($_POST['rg']);
        $dao = new ClienteDAO();
        $dao->atualizarCliente($cliente);
        header('Location: controllers/../controllerCliente.php?opcao=exibirTodos');
    } else {
        session_start();
        $_SESSION['erro1'] = $retorno_verificacao;
        header("Location:../views/formAlterarCliente.php?erro=1");
    }
}
