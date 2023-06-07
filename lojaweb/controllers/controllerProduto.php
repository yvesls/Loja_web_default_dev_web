<?php
    require_once("../classes/Produto.inc");
    require_once("../dao/produtoDAO.inc.php");
    
    $opcao = $_REQUEST['opcao'];
    function incluirProduto(){
        $produto = new Produto();
        $produto->setNome($_POST['nome']);
        $produto->setDescricao( (string) $_POST['descricao']);
        $produto->setEstoque($_POST['estoque']);
        $produto->setDataFabricacao($_POST['dataFabricacao']);
        $produto->setFabricante($_POST['fabricante']);
        $produto->setPreco($_POST['preco']);
        $produto->setReferencia($_POST['referencia']);

        $produtoDAO = new ProdutoDAO();
        if(!$produtoDAO->incluirProduto($produto)) {
            header("Location:../views/formProdutos.php?erro=1");
            return;
        }
        header('Location: ../views/formProdutos.php?inclusao=1');
    }

    if($opcao == "incluir"){
        if(empty($_POST['nome']) || empty($_POST['descricao']) || empty($_POST['estoque']) || empty($_POST['dataFabricacao']) || empty($_POST['fabricante']) || empty($_POST['preco']) || empty($_POST['referencia'])) {
            header("Location:../views/formProdutos.php?erro=2");
        }
        else {
            incluirProduto();
        }
    }

    if($opcao == 2){    //Exibir todos os produtos
        $produtoDAO = new ProdutoDAO();
        $listaProdutos = $produtoDAO.getProdutos();
        
        //Coloca a lista de produtos na sessão
        session_start();
        $_SESSION["produtos"] = $listaProdutos;

        header("Location: ../views/exibirProdutos.php");
    }

?>