<?php
     require_once 'includes/cabecalho.inc.php';
?>
    
    <form align="center" action="../controllers/controllerProduto.php" method="POST">
        <h2>Cadastrar produto</h2>
        Nome: <input type="text" size="20" name="nome"><p>
        Data de fabricação: <input type="text" size="20" name="dataFabricacao"><p>
        Preço: <input type="text" size="20" name="nome"><p>
        Quantidade em estoque: <input type="text" size="20" name="estoque"><p>
        Descrição do produto: <textarea name="descricao" rows="4" cols="50"></textarea><p>
        Número de referência: <input type="text" size="20" name="referencia"><p>
        Código do fabricante: <input type="text" size="20" name="fabricante"><p>
        <input type="hidden" name="opcao" value="1">
        <input type="submit" value="Registrar"><input type="reset" value="Cancelar">
    </form>

<?php
     require_once 'includes/rodape.inc.php';
?>