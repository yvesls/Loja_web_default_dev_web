<?php
require_once("../dao/produtoDAO.inc.php");
require_once("../classes/Item.inc.php");

$opcao = $_REQUEST['opcao'];

function array_search2($chave, $vetor)
{
    $index = -1;
    for ($i = 0; $i < count($vetor); $i++) {
        if ($chave == $vetor[$i]->getProduto()->getProdutoId()) {
            $index = $i;
            break;
        }
    }
    return $index;
}

if ($opcao == "inserir") {
    $id = $_REQUEST['id'];
    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->consultarProdutoPorId($id);

    session_start();
    if (!isset($_SESSION["carrinho"])) {
        $carrinho = [];
    } else {
        $carrinho = $_SESSION["carrinho"];
    }

    $item = new Item($produto);
    $index = array_search2($item->getProduto()->getProdutoId(), $carrinho);
    if ($index != -1) {
        $carrinho[$index]->setQuantidade();
        $carrinho[$index]->setValorItem();
    } else {
        $carrinho[] = $item;
    }

    $_SESSION["carrinho"] = $carrinho;
    header("Location: ../views/exibirCarrinho.php");
}

if ($opcao == "excluir") {
    session_start();
    $index = (int)$_REQUEST["id"];
    $carrinho = $_SESSION["carrinho"];

    for ($i = 0; $i < count($carrinho); $i++) {
        if ($index == $carrinho[$i]->getProduto()->getProdutoId()) {
            unset($carrinho[$i]);
            break;
        }
    }

    $_SESSION["carrinho"] = $carrinho;
    header("Location: ../views/exibirCarrinho.php");
}

if ($opcao == "esvaziarCarrinho") {
    session_start();

    unset($_SESSION["carrinho"]);
    header("Location: controllerProduto.php?opcao=exibirProdutosVenda");
}

if ($opcao == "processoVenda") {
    $total = (float)$_REQUEST['total'];
    session_start();
    $_SESSION["total"] = $total;
    if (isset($_SESSION["cliente"])) {
        header("Location: ../views/dadosCompra.php");
    } else {
        header("Location: ../views/formLoginCliente.php");
    }
}
