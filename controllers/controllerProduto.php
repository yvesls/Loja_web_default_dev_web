<?php
require_once("../classes/Produto.inc.php");
require_once("../dao/produtoDAO.inc.php");

$opcao = $_REQUEST['opcao'];

function validate($tipo)
{
    if ($tipo == "alterar") {
        $camposObrigatorios = array(
            'nome',
            'descricao',
            'estoque',
            'fabricante',
            'preco',
            'referencia'
        );
    } else {
        $camposObrigatorios = array(
            'nome',
            'descricao',
            'estoque',
            'dataFabricacao',
            'fabricante',
            'preco',
            'referencia'
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
function incluirProduto()
{
    $produto = new Produto();
    $produto->setNome($_POST['nome']);
    $produto->setDescricao((string) $_POST['descricao']);
    $produto->setEstoque($_POST['estoque']);
    $produto->setDataFabricacao($_POST['dataFabricacao']);
    $produto->setFabricante($_POST['fabricante']);
    $produto->setPreco($_POST['preco']);
    $produto->setReferencia($_POST['referencia']);

    $dao = new ProdutoDAO();
    if (!$dao->incluirProduto($produto)) {
        header("Location:../views/formProdutos.php?erro=1");
        return;
    }
    header('Location: ../views/formProdutos.php?inclusao=1');
}

if ($opcao == "incluir") {
    $retorno_verificacao = validate("incluir");
    if ($retorno_verificacao == null) {
        incluirProduto();
    } else {
        session_start();
        $_SESSION['erro2'] = $retorno_verificacao;
        header("Location:../views/formProdutos.php?erro=2");
    }
}

if ($opcao == "exibirTodos" || $opcao == "exibirProdutosVenda") {    //Exibir todos os produtos

    $produtoDAO = new ProdutoDAO();
    $listaProdutos = $produtoDAO->getProdutos();
    //Coloca a lista de produtos na sessão
    session_start();
    $_SESSION["produtos"] = $listaProdutos;
    if ($opcao == "exibirTodos") {
        header("Location: ../views/exibirProdutos.php");
    } else {
        header("Location: ../views/exibirProdutosVenda.php");
    }
}

if ($opcao == "excluir") {
    $id = $_REQUEST['id'];
    $ProdutoDAO = new ProdutoDAO();
    $ProdutoDAO->excluirProduto($id);
    header('Location: controllers/../controllerProduto.php?opcao=exibirTodos');
}
if ($opcao == "buscarPorId") {
    $id = $_REQUEST['id'];
    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->consultarProdutoPorId($id);
    session_start();
    $_SESSION["produto"] = $produto;
    header('Location: controllerFabricante.php?opcao=exibirTodosPorAlterar');
}

if ($opcao == "alterar") {
    $retorno_verificacao = validate("alterar");
    if ($retorno_verificacao == null) {
        $produto = new Produto();
        $produto->setProdutoId($_POST['produto_id']);
        $produto->setNome($_POST['nome']);
        $produto->setDescricao((string) $_POST['descricao']);
        $produto->setEstoque($_POST['estoque']);
        $produto->setFabricante($_POST['fabricante']);
        $produto->setPreco($_POST['preco']);
        $produto->setReferencia($_POST['referencia']);
        $produtoDAO = new ProdutoDAO();
        $produtoDAO->atualizarProduto($produto);
        header('Location: controllers/../controllerProduto.php?opcao=exibirTodos');
    } else {
        session_start();
        $_SESSION['erro1'] = $retorno_verificacao;
        header("Location:../views/formAlterarProduto.php?erro=1");
    }
}
