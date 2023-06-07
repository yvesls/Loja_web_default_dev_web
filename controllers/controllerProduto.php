<?php
    require_once("../classes/Produto.inc.php");
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

        $dao = new ProdutoDAO();
        if(!$dao->incluirProduto($produto)) {
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
            header('Location: ../views/exibirProdutos.php');
        }
    }

    if($opcao == "exibirTodos"){    //Exibir todos os produtos
        $produtoDAO = new ProdutoDAO();
        $listaProdutos = $produtoDAO->getProdutos();
        //Coloca a lista de produtos na sessão
        session_start();
        $_SESSION["produtos"] = $listaProdutos;

        header("Location: ../views/exibirProdutos.php");
    }

    if($opcao == "excluir"){
        $id = $_REQUEST['id'];
        $produtoDAO = new ProdutoDAO();
        $produtoDAO->excluirProduto($id);
        header('Location: ../views/exibirProdutos.php?opcao=exibirTodos');
    }
    if($opcao == "buscarPorId") {
        $id = $_REQUEST['id'];
        $produtoDAO = new ProdutoDAO();
        $produto = $produtoDAO->consultarProdutoPorId($id);
        session_start();
        $_SESSION["produto"] = $produto;
        header('Location: controllerFabricante.php?opcao=exibirTodosPorAlterar');
    }
    
    if($opcao == "alterar") {
        $produto = new Produto();
        $produto->setProdutoId($_POST['produto_id']);
        $produto->setNome($_POST['nome']);
        $produto->setDescricao( (string) $_POST['descricao']);
        $produto->setEstoque($_POST['estoque']);
        $produto->setDataFabricacao($_POST['dataFabricacao']);
        $produto->setFabricante($_POST['fabricante']);
        $produto->setPreco($_POST['preco']);
        $produto->setReferencia($_POST['referencia']);
        $produtoDAO = new ProdutoDAO();
        $produtoDAO->atualizarProduto($produto);
        header('Location: ../views/exibirProdutos.php?opcao=exibirTodos');
    }

?>