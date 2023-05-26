<?php
    require_once("../dao/conexao.inc.php");
    
    function efetuarLogin($login, $senha){
        $con = new Conexao();
        $conexao = $con->getConexao();
        
        $sql = $conexao->prepare("select * from usuarios where login = :user and senha = :pass");
        $login = strtolower($login);
        $senha = strtolower($senha);

        $sql->bindValue(":user", $login);
        $sql->bindValue(":pass", $senha);
        $sql->execute();

        //Conta as linhas no banco de dados
        $count = $sql->rowCount();
        echo $count;
        if($count){
            return true;
        }
        else{
            return false;
        }
    }

    //Dados do banco de dados
    $tipo = $_REQUEST["pTipo"];
    $login = $_REQUEST["pLogin"];
    $senha = $_REQUEST["pSenha"];

    if($tipo == 1){
        $logado = efetuarLogin($login, $senha);
        
        if($logado == true){
            echo "entrou aqui";
            session_start();
            $_SESSION["logado"] = true;
            $_SESSION["tipousuario"] = '1';
            header("Location:../views/index.php");
        }
    }
    else{
        header("Location:../views/formLogin.php?erro=1");
    }

?>