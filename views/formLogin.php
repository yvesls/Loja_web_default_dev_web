<?php
     require_once 'includes/cabecalho.inc.php';
?>
    <form align="center" action="../controllers/controllerLogin.php" method="GET">
        Login: <input type="text" size="20" name="pLogin"><p>
        Senha: <input type="password" size="10" name="pSenha"><p>
        Tipo de usuário:
        <select name="pTipo" id="">
            <option value="1">Administrador</option>
            <option value="2">Cliente</option>
        </select><p>
        <input type="submit" value="Entrar"><input type="reset" value="Cancelar">
    </form>

<?php
     require_once 'includes/rodape.inc.php';
?>

<?php
    //$erro = $_REQUEST["erro"];
    if(isset($_REQUEST["erro"])){   //Verifica se o parâmetro "erro" existe

        if((int)($_REQUEST["erro"]) == 1){    //Captura o "erro"
            echo("<b><font face='Verdana' size='2' color='red'>Login incorreto.</font></b>");
        }

        else if($_REQUEST["erro"] == 2){
            echo("<b>Por favor, efetur o login novamente.</b>");
        }
    }
?>