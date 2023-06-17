<?php
require_once("../dao/produtoDAO.inc.php");
require_once("../classes/Produto.inc.php");

$opcao = $_REQUEST['opcao'];

if ($opcao == "inserir") {
    $id = $_REQUEST['id'];
    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->consultarProdutoPorId($id);
    $adicionou = false;
    session_start();
    if (!isset($_SESSION["carrinho"])) {
        $carrinho = [];
        $carrinho[] = $produto;
    } else {
        $carrinho = $_SESSION["carrinho"];
        foreach ($carrinho as $item) {
            if ($item->getProdutoId() == $produto->getProdutoId()) {
                $item->quantidadeNoCarrinho += 1;
                $item->setPreco($item->getPreco() + $item->getPreco());
                $adicionou = true;
            }
        }
    }
    if (!$adicionou) {
        $carrinho[] = $produto;
    }
    foreach ($carrinho as $item) {
        if ($item->quantidadeNoCarrinho == null) {
            $item->quantidadeNoCarrinho = 1;
        }
    }
    $_SESSION["carrinho"] = $carrinho;
    header("Location: ../views/exibirCarrinho.php");
}

if ($opcao == "excluir") {
    session_start();
    $carrinho = $_SESSION["carrinho"];

    foreach ($carrinho as $key => $item) {
        if ($item->getProdutoId() == $_REQUEST['id']) {
            if ($item->quantidadeNoCarrinho > 1) {
                $precoUnidade = floatval($item->getPreco()) / $item->quantidadeNoCarrinho;
                $item->setPreco($item->getPreco() - $precoUnidade);
                echo $precoUnidade;
                $item->quantidadeNoCarrinho -= 1;
            } else {
                unset($carrinho[$key]);
            }
        }
    }
    $_SESSION["carrinho"] = $carrinho;
    header("Location: ../views/exibirCarrinho.php");
}
