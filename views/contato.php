<?php
     require_once 'includes/cabecalho.inc.php';
?>
    <form align="center" action="../controllers/controllerContato.php" method="POST">
        Nome: <input type="text" size="20" name="pNome"><p>
        Email: <input type="text" size="20" name="pEmail"><p>
        Mensagem: <textarea name="pMensagem" cols="30" rows="10"></textarea><p>
        <input type="hidden" name="opcao" value="1">
        <input type="submit" value="Enviar"><input type="reset" value="Cancelar">
    </form>

<?php
     require_once 'includes/rodape.inc.php';
?>