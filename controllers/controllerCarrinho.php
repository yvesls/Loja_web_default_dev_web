<?php
require_once("../dao/produtoDAO.inc.php");
require_once("../classes/Produto.inc.php");

$opcao = $_REQUEST['opcao'];

if ($opcao == "inserir") {
    $id = $_REQUEST['id'];
    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->consultarProdutoPorId($id);

    session_start();
    if (!isset($_SESSION["carrinho"])) {
        $carrinho = [];
        $carrinho[] = $produto;
    } else {
        $carrinho = $_SESSION["carrinho"];
        $adicionou = false;
        foreach ($carrinho as $item) {
            if ($item->getProdutoId() == $produto->getProdutoId()) {
                $item->setPreco($item->getPreco() + $item->getPreco());
                $adicionou = true;
            }
        }
    }
    if (!$adicionou) {
        $carrinho[] = $produto;
    }
    $_SESSION["carrinho"] = $carrinho;
    header("Location: ../views/exibirCarrinho.php");
}
