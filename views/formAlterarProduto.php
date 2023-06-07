<?php
     require_once 'includes/cabecalho.inc.php';

    session_start();
    $produto = $_SESSION["produto"];
    $fabricantes = $_SESSION['fabricantes'];
?>
    <form align="center" action="../controllers/controllerProduto.php" method="POST">
        <h2>Editar produto</h2>
        <input type="hidden" name="produto_id" value="<?=  $produto->getProdutoId() ?>">
        Nome: <input type="text" size="20" name="nome" value="<?=  $produto->getNome() ?>"><p>
        Data de fabricação: <input type="text" size="20" name="dataFabricacao" value="<?=  $produto->getDataFabricacao() ?>"><p>
        Preço: <input type="text" size="20" name="preco" value="<?=  $produto->getPreco() ?>"><p>
        Quantidade em estoque: <input type="text" size="20" name="estoque" value="<?=  $produto->getEstoque() ?>"><p>
        Descrição do produto: <textarea name="descricao" rows="4" cols="50" value="<?=  $produto->getDescricao() ?>"></textarea><p>
        Número de referência: <input type="text" size="20" name="referencia" value="<?=  $produto->getReferencia() ?>"><p>

        Fabricante: <select name="fabricante">
        <option value="<?=  $produto->getFabricante() ?>">-</option>
        <?php
        foreach($fabricantes as $fab){
            echo "<option value='".$fab->codigo."'>$fab->nome</option>";
        }
        ?>
        </select><p>
        <input type="hidden" name="opcao" value="alterar">
        <input type="submit" value="Registrar"><input type="reset" value="Cancelar">
    </form>

<?php
     require_once 'includes/rodape.inc.php';
?>