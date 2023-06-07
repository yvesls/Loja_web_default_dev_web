<?php
    require_once("../dao/fabricanteDAO.inc.php");
    
    $opcao = $_REQUEST['opcao'];

    if($opcao == "exibirTodos" || $opcao == "exibirTodosPorAlterar"){    //Exibir todos os produtos
        $fabricanteDAO = new FabricanteDAO();
        $listaFabricantes = $fabricanteDAO->getTodosFabricantes();
        //Coloca a lista de produtos na sessão
        session_start();
        $_SESSION["fabricantes"] = $listaFabricantes;

        if($opcao == "exibirTodos") {
            header("Location: ../views/formProdutos.php");
        }
        if($opcao == "exibirTodosPorAlterar") {
            header('Location: ../views/formAlterarProduto.php');
        }
    }