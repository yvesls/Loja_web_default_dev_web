<?php
require_once 'includes/cabecalho.inc.php';
require_once '../classes/Produto.inc.php';

session_start();
$produto = $_SESSION["produto"];
$fabricantes = $_SESSION['fabricantes'];
if (isset($_REQUEST["erro"])) {
    if ((int)($_REQUEST["erro"]) == 1) {
        echo ("<b><font face='Verdana' size='2' color='red'>" . $_SESSION['erro1'] . "</font></b>");
    }
}
?>
 <form action="../controllers/controllerProduto.php" method="post" class="form" enctype="multipart/form-data">
    <h2>Editar produto</h2><br><br>
    <input type="hidden" name="produto_id" value="<?= $produto->getProdutoId() ?>">
    Nome: <input type="text" size="20" name="nome" value="<?= $produto->getNome() ?>"><br><br>
    <!-- Data de fabricação: <input type="text" size="20" name="dataFabricacao" value="<?= $produto->getDataFabricacao() ?>"><br><br> -->
    Preço: <input type="text" size="20" name="preco" value="<?= $produto->getPreco() ?>"><br><br>
    Quantidade em estoque: <input type="text" size="20" name="estoque" value="<?= $produto->getEstoque() ?>"><br><br>
    Descrição do produto: <textarea name="descricao" rows="4" cols="50"><?= $produto->getDescricao() ?></textarea><br><br>
    Número de referência: <input type="text" size="20" name="referencia" value="<?= $produto->getReferencia() ?>"><br><br>

    Fabricante: <select name="fabricante">
        <option value="<?= $produto->getCodFabricante() ?>"> <?= $produto->getFabricante() ?></option>
        <?php
        foreach ($fabricantes as $fab) {
            echo "<option value='" . $fab->codigo . "'>$fab->nome</option>";
        }
        ?>
    </select>
    <div class="form-group">
            <label for="imagem">Alterar foto: </label>
            <input type="file" name="imagem" id="imagem">
    </div>
    <p>
        <input type="hidden" name="opcao" value="alterar">
        <input type="submit" value="Registrar"><input type="reset" value="Cancelar">
</form>

<?php
require_once 'includes/rodape.inc.php';
?>