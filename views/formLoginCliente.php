<?php
require_once 'includes/cabecalho.inc.php';
?>
<form align="center" action="../controllers/controllerCliente.php" method="GET">
    <h2>Login cliente</h2>
    <br>
    Login: <input type="text" size="20" name="pLogin">
    <br>
    Senha: <input type="password" size="10" name="pSenha">
    <br>
    <input type="hidden" name="opcao" value="logar">
    <input type="submit" value="Entrar"><input type="reset" value="Cancelar">
</form>

<?php
require_once 'includes/rodape.inc.php';
?>

<?php
//$erro = $_REQUEST["erro"];
if (isset($_REQUEST["erro"])) {   //Verifica se o parâmetro "erro" existe

    if ((int)($_REQUEST["erro"]) == 1) {    //Captura o "erro"
        echo ("<center><b><font face='Verdana' size='2' color='red'>Login incorreto.</font></b></center>");
    } else if ($_REQUEST["erro"] == 2) {
        echo ("<b>Por favor, efetur o login novamente.</b>");
    }
}
?>